<?php

namespace LaraZeus\InlineChart\Tests\Fixtures;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\TableComponent;
use LaraZeus\InlineChart\Tables\Columns\InlineChart;

class TestItemsTable extends TableComponent
{
    public function table(Table $table): Table
    {
        return $table
            ->query(TestItem::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('score')
                    ->sortable()
                    ->toggleable(),
                InlineChart::make('chart')
                    ->chart(TestInlineChartWidget::class)
                    ->maxWidth(200)
                    ->maxHeight(50)
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'alpha' => 'Alpha',
                        'beta' => 'Beta',
                    ]),
            ]);
    }

    public function render(): string
    {
        return <<<'HTML'
        <div>
            {{ $this->table }}
        </div>
        HTML;
    }
}
