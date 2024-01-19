<?php

namespace LaraZeus\InlineChart\Tables\Columns;

use Filament\Support\Concerns\HasIcon;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanWrap;
use Filament\Tables\Columns\Concerns\HasDescription;

class InlineChart extends Column
{
    use CanWrap;
    use HasDescription;
    use HasIcon;

    protected string $view = 'zeus-inline-chart::tables.columns.inline-chart';

    protected ?string $chart = null;

    protected string $maxWidth = '!w-[150px]';

    public function chart(string $chart): static
    {
        $this->chart = $chart;

        return $this;
    }

    public function getChart(): string
    {
        if ($this->chart === null) {
            throw new \Exception('set the chart class first');
        }

        return $this->chart;
    }

    public function maxWidth(string $maxWidth): static
    {
        $this->maxWidth = $maxWidth;

        return $this;
    }

    public function getMaxWidth(): string
    {
        return $this->maxWidth;
    }
}
