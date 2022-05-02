<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Default buttons</h2>
        <p class="lead italic">Bootstrap includes several predefined button styles, each serving its own semantic purpose,
            with a few extras thrown in for more control.</p>
    </div>

    <div class="d-flex flex-wrap justify-content-around">
        @foreach ( $buttons['bootstrap'] as $button )
            <div class="me-5 mb-3">
                <button type="button" class="btn btn-{{ $button['name'] }}">{{ $button['name'] }}</button>
            </div>
        @endforeach
    </div>
</x-utils.container>
