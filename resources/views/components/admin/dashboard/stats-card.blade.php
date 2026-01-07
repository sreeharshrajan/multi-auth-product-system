    <div class="stat hover:shadow transition duration-300">
        <div class="stat-figure text-primary">
            @if (isset($icon))
                <span class="icon flex items-center justify-center w-12 h-12 bg-primary/10 rounded-lg">
                    <i class="ph ph-{{ $icon }} text-2xl"></i>
                </span>
            @endif
        </div>
        <div class="stat-title text-base">{{ $title }}</div>
        <div class="stat-value text-primary">{{ $value }}</div>
        @if (isset($description))
            <div class="stat-desc">{{ $description }}</div>
        @endif
    </div>
