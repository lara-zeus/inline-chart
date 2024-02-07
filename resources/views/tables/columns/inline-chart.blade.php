<div wire:ignore>
    @php
        $getState = $getState();
        $getMaxWidth = $getMaxWidth();
        $getMaxHeight = $getMaxHeight();
        $getIcon = $getIcon($getState);
        $descriptionAbove = $getDescriptionAbove();
        $descriptionBelow = $getDescriptionBelow();
        $canWrap = $canWrap();
        $getChart = $getChart();
        $getRecord = $getRecord();
    @endphp

    @if (filled($descriptionAbove))
        <p
            @class([
              'text-sm text-gray-500 dark:text-gray-400',
              'whitespace-normal' => $canWrap,
            ])
        >
            {{ $descriptionAbove }}
        </p>
    @endif

    <div
        wire:ignore
        style="
            width: {{ $getMaxWidth }}px !important;
            height: {{ $getMaxHeight }}px !important;
           "
    >
        @livewire($getChart, ['maxWidth' => $getMaxWidth, 'maxHeight' => $getMaxHeight, 'lazy' => true, 'record' => $getRecord], key("chart-{$getRecord->id}"))
    </div>

    @if (filled($descriptionBelow))
        <p
            @class([
                'text-sm text-gray-500 dark:text-gray-400',
                'whitespace-normal' => $canWrap,
            ])
        >
            {{ $descriptionBelow }}
        </p>
    @endif

    @pushonce('scripts')
        <script>
          const externalTooltipHandler = (context) => {
            const { chart, tooltip } = context
            let tooltipEl = chart.canvas.parentNode.querySelector('.tooltipElement')

            if (tooltip.opacity === 0) {
              tooltipEl.style.opacity = 0
              return
            }

            if (tooltip.body) {
              const titleLines = tooltip.title || []
              const bodyLines = tooltip.body.map(b => b.lines)
              var innerHtml = '<span>'

              titleLines.forEach(function(title) {
                innerHtml += title
              })
              innerHtml += '</span><span>'

              bodyLines.forEach(function(body, i) {
                innerHtml += ' ' + body
              })
              innerHtml += '</span>'

              tooltipEl.innerHTML = innerHtml
            }

            const { offsetLeft: positionX, offsetTop: positionY } = chart.canvas

            tooltipEl.style.opacity = 1
            tooltipEl.style.left = positionX + tooltip.caretX + 'px'
            tooltipEl.style.top = positionY + tooltip.caretY + 'px'
          }
        </script>
    @endpushonce
</div>
