@php
        use Filament\Support\Enums\MaxWidth;
        use Filament\Support\Facades\FilamentView;

        $color = $this->getColor();
        $heading = $this->getHeading();
        $filters = $this->getFilters();
@endphp
<x-filament-widgets::widget class="fi-wi-chart">
    <div
        @class([
            'px-2',
            match ($maxWidth) {
                MaxWidth::ExtraSmall, 'xs' => 'max-w-xs',
                MaxWidth::Small, 'sm' => 'max-w-sm',
                MaxWidth::Medium, 'md' => 'max-w-md',
                MaxWidth::Large, 'lg' => 'max-w-lg',
                MaxWidth::ExtraLarge, 'xl' => 'max-w-xl',
                MaxWidth::TwoExtraLarge, '2xl' => 'max-w-2xl',
                MaxWidth::ThreeExtraLarge, '3xl' => 'max-w-3xl',
                MaxWidth::FourExtraLarge, '4xl' => 'max-w-4xl',
                MaxWidth::FiveExtraLarge, '5xl' => '!max-w-5xl bord',
                MaxWidth::SixExtraLarge, '6xl' => 'max-w-6xl',
                MaxWidth::SevenExtraLarge, '7xl' => '!max-w-7xl bord',
                null => 'w-[14rem]',
                default => $maxWidth,
            },
        ])
    >
        <div
            @if ($pollingInterval = $this->getPollingInterval())
                    wire:poll.{{ $pollingInterval }}="updateChartData"
            @endif
        >
            <div
                @if (FilamentView::hasSpaMode())
                        ax-load="visible"
                @else
                        ax-load
                @endif
                ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('chart', 'filament/widgets') }}"
                wire:ignore
                x-data="chart({
                    cachedData: @js($this->getCachedData()),
                    options: @js($this->getOptions()),
                    type: @js($this->getType()),
                })"
                x-ignore
            >
                <canvas
                        x-ref="canvas"
                        @if ($maxHeight = $this->getMaxHeight())
                                style="max-height: {{ $maxHeight }}"
                        @endif
                ></canvas>

                <span
                    x-ref="backgroundColorElement"
                    @class([
                        match ($color) {
                            'gray' => 'text-gray-100 dark:text-gray-800',
                            default => 'text-custom-50 dark:text-custom-400/10',
                        },
                    ])
                    @style([
                        \Filament\Support\get_color_css_variables(
                            $color,
                            shades: [50, 400],
                            alias: 'widgets::chart-widget.background',
                        ) => $color !== 'gray',
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
                    @style([
                        \Filament\Support\get_color_css_variables(
                            $color,
                            shades: [400, 500],
                            alias: 'widgets::chart-widget.border',
                        ) => $color !== 'gray',
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

                <p class="my-1 text-center tooltipElement text-sm text-gray-500 dark:text-gray-400"><br></p>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
