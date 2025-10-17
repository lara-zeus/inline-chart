@php
    use Filament\Support\Enums\MaxWidth;
    use Filament\Support\Facades\FilamentView;

    $color = $this->getColor();
    $heading = $this->getHeading();
    $filters = $this->getFilters();
@endphp
<x-filament-widgets::widget wire:ignore>
    <div
        @if ($pollingInterval = $this->getPollingInterval())
            wire:poll.{{ $pollingInterval }}="updateChartData"
        @endif
    >
        <div
            @if (FilamentView::hasSpaMode())
                x-load="visible"
            @else
                x-load
            @endif
            x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('chart', 'filament/widgets') }}"

            x-data="chart({
                cachedData: @js($this->getCachedData()),
                options: @js($this->getOptions()),
                type: @js($this->getType()),
            })"
            x-ignore
        >
            <canvas
                x-ref="canvas"
                style="
                    width: {{ (int) $maxWidth }}px !important;
                    height: {{ (int) $this->getMaxHeight() }}px !important;
                "
            ></canvas>

            <span
                x-ref="backgroundColorElement"
                @class([
                    match ($color) {
                        'gray' => 'text-gray-100 dark:text-gray-800',
                        default => 'text-custom-50 dark:text-custom-400/10',
                    },
                ])
            ></span>

            <span
                x-ref="borderColorElement"
                @class([
                    match ($color) {
                        'gray' => 'text-gray-400',
                        default => 'text-custom-500 dark:text-custom-400',
                    },
                ])
            ></span>

            <span
                x-ref="gridColorElement"
                class="text-gray-200 dark:text-gray-800"
            ></span>

            <span
                x-ref="textColorElement"
                class="text-gray-500 dark:text-gray-400"
            ></span>

        </div>
        <p class="my-1 text-center tooltipElement text-sm text-gray-500 dark:text-gray-400"><br></p>
    </div>
</x-filament-widgets::widget>
