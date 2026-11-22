<?php

use LaraZeus\InlineChart\Tests\Fixtures\TestInlineChartWidget;
use LaraZeus\InlineChart\Tests\Fixtures\TestItem;
use LaraZeus\InlineChart\Tests\Fixtures\TestItemsTable;
use Livewire\Livewire;

beforeEach(function (): void {
    $this->alpha = TestItem::query()->create([
        'name' => 'Alpha Item',
        'category' => 'alpha',
        'score' => 10,
    ]);

    $this->beta = TestItem::query()->create([
        'name' => 'Beta Item',
        'category' => 'beta',
        'score' => 20,
    ]);

    $this->gamma = TestItem::query()->create([
        'name' => 'Gamma Item',
        'category' => 'alpha',
        'score' => 30,
    ]);
});

it('renders inline chart column without wire:ignore wrapping the nested livewire component', function (): void {
    $component = Livewire::test(TestItemsTable::class);
    $html = $component->html();

    expect($html)
        ->toContain("wire:key=\"inline-chart-chart-{$this->alpha->id}\"")
        ->toContain("wire:key=\"chart-chart-{$this->alpha->id}\"")
        ->not->toContain('<div wire:ignore>');
});

it('renders inline chart widget with wire:ignore only on the inner chart container', function (): void {
    $component = Livewire::test(TestInlineChartWidget::class, [
        'record' => $this->alpha,
        'maxWidth' => 200,
        'maxHeight' => 50,
    ]);

    $html = $component->html();

    expect($html)
        ->toContain('class="fi-wi-widget')
        ->toContain('wire:ignore')
        ->not->toMatch('/<div[^>]*class="fi-wi-widget[^"]*"[^>]*wire:ignore/');
});

it('supports repeated sorting, searching, filtering, and column toggling without breaking', function (): void {
    $table = Livewire::test(TestItemsTable::class);

    // Initial render shows all records and their chart keys
    $table
        ->assertCanSeeTableRecords([$this->alpha, $this->beta, $this->gamma])
        ->assertSee("wire:key=\"chart-chart-{$this->alpha->id}\"", false);

    // 1. Sort ascending, then descending, then by score
    $table
        ->call('sortTable', 'name')
        ->assertCanSeeTableRecords([$this->alpha, $this->beta, $this->gamma], inOrder: true)
        ->call('sortTable', 'name')
        ->assertCanSeeTableRecords([$this->gamma, $this->beta, $this->alpha], inOrder: true)
        ->call('sortTable', 'score')
        ->assertCanSeeTableRecords([$this->alpha, $this->beta, $this->gamma], inOrder: true);

    // 2. Search and clear search multiple times
    $table
        ->set('tableSearch', 'Beta')
        ->assertCanSeeTableRecords([$this->beta])
        ->assertCanNotSeeTableRecords([$this->alpha, $this->gamma])
        ->set('tableSearch', '')
        ->assertCanSeeTableRecords([$this->alpha, $this->beta, $this->gamma]);

    // 3. Filter and reset filter multiple times
    $table
        ->set('tableFilters.category.value', 'alpha')
        ->assertCanSeeTableRecords([$this->alpha, $this->gamma])
        ->assertCanNotSeeTableRecords([$this->beta])
        ->set('tableFilters.category.value', null)
        ->assertCanSeeTableRecords([$this->alpha, $this->beta, $this->gamma]);

    // 4. Toggle chart column off and back on, then sort again
    $columnsOff = collect($table->get('tableColumns'))
        ->map(fn (array $col): array => $col['name'] === 'chart' ? [...$col, 'isToggled' => false] : $col)
        ->all();

    $columnsOn = collect($columnsOff)
        ->map(fn (array $col): array => $col['name'] === 'chart' ? [...$col, 'isToggled' => true] : $col)
        ->all();

    $table
        ->set('tableColumns', $columnsOff)
        ->assertDontSee("wire:key=\"chart-chart-{$this->alpha->id}\"", false)
        ->set('tableColumns', $columnsOn)
        ->assertSee("wire:key=\"chart-chart-{$this->alpha->id}\"", false)
        ->call('sortTable', 'score')
        ->assertCanSeeTableRecords([$this->gamma, $this->beta, $this->alpha], inOrder: true);
});
