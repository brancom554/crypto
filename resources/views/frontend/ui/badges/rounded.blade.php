<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Rounded</h2>
        <p class="lead italic">Use the <code>.badge-pill</code> modifier class to make badges more rounded (with a larger
            <code>border-radius</code> and additional horizontal <code>padding</code>). Useful if you miss the
            badges from v3.</p>
    </div>

    <div class="row gap-y">
        <div class="col-12 d-flex flex-wrap justify-content-around">
            @foreach ($badges['bootstrap'] as $badge)
            <span class="badge rounded-pill bg-{{ $badge }} {{ $badge == "contrast" || $badge == "light" ? " text-primary" : "" }}">
                {{ $badge }}
            </span>
            @endforeach
        </div>

        <div class="col-12 d-flex flex-wrap justify-content-around">
            @foreach ($badges['bootstrap'] as $badge)
            <span class="badge rounded-pill badge-outline-{{ $badge }} {{ $badge == "contrast" || $badge == "light" ? " text-primary" : "" }}">
                {{ $badge }}
            </span>
            @endforeach
        </div>
    </div>
</x-utils.container>
