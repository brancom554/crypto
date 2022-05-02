<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Outline buttons</h2>
        <p class="lead italic">In need of a button, but not the hefty background colors they bring? Replace the default
            modifier classes with the .btn-outline-* ones to remove all background images and colors on any button.
        </p>
    </div>

    <div class="d-flex flex-wrap justify-content-around">
        @foreach ( $buttons['bootstrap'] as $button )
        <div class="me-5 mb-3">
            <button type="button" class="btn btn-outline-{{ $button['name'] }} {{ $button['name'] == "contrast" || $button['name'] == "light" ? " text-primary" : "" }}">
                {{ $button['name'] }}
            </button>
        </div>
        @endforeach
    </div>
</x-utils.container>
