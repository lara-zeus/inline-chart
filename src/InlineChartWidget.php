<?php

namespace LaraZeus\InlineChart;

use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;

abstract class InlineChartWidget extends ChartWidget
{
    protected static string $view = 'zeus-inline-chart::widgets.inline-chart';

    protected static ?string $maxHeight = '50px';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Chart';

    public ?string $maxWidth = '!w-[150px]';

    public Model $record;

    protected function getOptions(): RawJs
    {
        return RawJs::make(<<<'JS'
        {
            plugins: {
                legend: {
                        display: false,
                    },
                tooltip: {
                    enabled: false,
                    external: externalTooltipHandler
                }
            },
            scales: {
                y: {
                    ticks: {
                        display: false,
                    },
                    grid: {
                        display: false,
                    },
                },
                x: {
                    ticks: {
                        display: false,
                    },
                    grid: {
                        display: false,
                    },
                },
            },
        }
        JS);
    }

    protected function getType(): string
    {
        return 'line';
    }
}
