## Lara Zeus Inline Chart (`lara-zeus/inline-chart`)

Renders lazy-loaded Filament `ChartWidget` sparklines/mini charts inside Filament table columns, scoped to each row's `$record`.

### Key Classes
- Table Column: `LaraZeus\InlineChart\Tables\Columns\InlineChart` (extends `Filament\Tables\Columns\Column`)
- Widget Base Class: `LaraZeus\InlineChart\InlineChartWidget` (extends `Filament\Widgets\ChartWidget`)
- ServiceProvider: `LaraZeus\InlineChart\InlineChartServiceProvider` (package name: `zeus-inline-chart`, loads views)
- No Filament `Plugin` class, config file, or migrations.

### Rules & Anti-Patterns
- **Always call `->chart(MyWidget::class)`**: `InlineChart::getChart()` throws `\Exception('set the chart class first')` if no widget class is provided.
- **Extend `InlineChartWidget`**: Your chart widget should extend `LaraZeus\InlineChart\InlineChartWidget` (which provides `public ?Model $record = null;`, custom external tooltip handling, and clean axis defaults) and implement `getData(): array`.
- **Use `$this->record` defensively**: `$this->record` is `null` by default on `InlineChartWidget` (e.g., before mount or outside table context), so guard with `$this->record?->...`.
- **Match `InlineChartWidget` property types**: `public int $maxWidth = 200`, `protected ?string $maxHeight = '50'`, `protected ?string $heading = 'Chart'` are non-static properties in `src/InlineChartWidget.php`; do not redeclare them as `static`.
