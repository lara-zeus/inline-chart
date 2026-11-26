---
name: zeus-inline-chart
description: Embed row-scoped Filament ChartWidget charts inside Filament table columns using Lara Zeus Inline Chart.
---

# Lara Zeus Inline Chart

## Overview & Requirements
`lara-zeus/inline-chart` provides the `InlineChart` Filament table column and `InlineChartWidget` base widget so each table row renders a lazy-loaded Livewire chart bound to that row's Eloquent `$record`.

- **Package**: `lara-zeus/inline-chart` (Free / MIT)
- **Requirements**: PHP `^8.1`, `filament/filament` `^5.0`, `spatie/laravel-package-tools` `^1.16`

## Installation
```bash
composer require lara-zeus/inline-chart
```

## Configuration & Migrations
None. `InlineChartServiceProvider` registers the `zeus-inline-chart` views only. There are no config files or database migrations.

## Filament Panel Registration
None. This package provides a table column and widget base class rather than a `Plugin` class.

## Core Usage

### 1. Create an `InlineChartWidget`
Extend `LaraZeus\InlineChart\InlineChartWidget` and use `$this->record` inside `getData()`:

```php
namespace App\Filament\Widgets;

use LaraZeus\InlineChart\InlineChartWidget;

class UserActivityChart extends InlineChartWidget
{
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Activity',
                    'data' => [1, 2, $this->record?->getAttribute('score') ?? 0],
                ],
            ],
            'labels' => ['Mon', 'Tue', 'Wed'],
        ];
    }
}
```

### 2. Add `InlineChart` to a Filament Table
Use `LaraZeus\InlineChart\Tables\Columns\InlineChart` in `$table->columns([...])`:

```php
use App\Filament\Widgets\UserActivityChart;
use LaraZeus\InlineChart\Tables\Columns\InlineChart;

InlineChart::make('activity')
    ->chart(UserActivityChart::class)
    ->maxWidth(350) // int, default: 200
    ->maxHeight(90) // int, default: 50
    ->description('Last 7 days')
    ->toggleable()
```

`InlineChart` uses Filament's `CanWrap`, `HasDescription`, and `HasIcon` traits and mounts the widget lazily per row with `['maxWidth', 'maxHeight', 'lazy' => true, 'record']`.

## Common Pitfalls & Anti-Patterns
- **Missing `->chart(...)` call**: Rendering `InlineChart` without `->chart(WidgetClass::class)` throws `\Exception('set the chart class first')`.
- **Static property mismatch**: `InlineChartWidget` defines non-static `public int $maxWidth = 200`, `protected ?string $maxHeight = '50'`, and `protected ?string $heading = 'Chart'`. Do not declare them as `static` on subclasses.
- **Unchecked `$this->record`**: Always use null-safe access (`$this->record?->...`) in `getData()` in case the widget is evaluated without a bound model.
