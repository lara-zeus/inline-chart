<?php

namespace LaraZeus\InlineChart\Tests\Fixtures;

use LaraZeus\InlineChart\InlineChartWidget;

class TestInlineChartWidget extends InlineChartWidget
{
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Score',
                    'data' => [1, 2, $this->record?->getAttribute('score') ?? 3],
                ],
            ],
            'labels' => ['A', 'B', 'C'],
        ];
    }
}
