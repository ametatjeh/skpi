{{-- resources/views/fakultas/components/stats-card.blade.php --}}
{{-- 
    Usage: @include('fakultas.components.stats-card', [
        'color'  => 'purple', // purple|green|yellow|blue
        'icon'   => 'fa-trophy',
        'label'  => 'SKPI Final',
        'value'  => 42,
        'change' => '+12% tahun ini',
        'trend'  => 'up', // up|down|neutral
    ])
--}}

@php
    $color  = $color ?? 'purple';
    $icon   = $icon ?? 'fa-chart-bar';
    $label  = $label ?? 'Label';
    $value  = $value ?? 0;
    $change = $change ?? '';
    $trend  = $trend ?? 'neutral';

    $trendIcon = match($trend) {
        'up'   => 'fa-arrow-up',
        'down' => 'fa-arrow-down',
        default => 'fa-minus',
    };
@endphp

<div class="stat-card {{ $color }}">
    <div class="stat-icon">
        <i class="fas {{ $icon }}"></i>
    </div>
    <div class="stat-content">
        <div class="stat-label">{{ $label }}</div>
        <div class="stat-value">{{ $value }}</div>
        @if($change)
            <div class="stat-change {{ $trend }}">
                <i class="fas {{ $trendIcon }}"></i>
                {{ $change }}
            </div>
        @endif
    </div>
</div>
