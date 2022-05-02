<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Outline badges</h2>
        <p class="lead italic">In need of a badge, but not the hefty background colors they bring? Replace the default
            modifier classes with the <code>.badge-outline-*</code> ones to remove all background images and colors
            on any badge.</p>
    </div>

    <div class="d-flex flex-wrap justify-content-around">
        @foreach ($badges['bootstrap'] as $badge)
        <span class="badge badge-outline-{{ $badge }} {{ $badge == "contrast" || $badge == "light" ? " text-primary" : "" }}">
            {{ $badge }}
        </span>
        @endforeach
    </div>
</x-utils.container>
