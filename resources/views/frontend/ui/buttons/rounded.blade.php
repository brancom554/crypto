<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Rounded</h2>
        <p class="lead italic">Bootstrap includes several predefined button styles, each serving its own semantic purpose,
            with a few extras thrown in for more control.</p>
    </div>

    <div class="bootstrap">
        <div class="row gap-y">
            <p class="b-b pb-2 mb-5 text-primary bold small">Solid</p>
            <div class="col-12 d-flex flex-wrap justify-content-around">
                @foreach ( $buttons['bootstrap'] as $button )
                <div class="me-5 mb-3">
                    <button type="button" class="btn btn-rounded btn-{{ $button['name'] }}">
                        {{ $button['name'] }}
                    </button>
                </div>
                @endforeach
            </div>

            <p class="b-b pb-2 mb-5 text-primary bold small">Outlined</p>
            <div class="col-12 d-flex flex-wrap justify-content-around">
                @foreach ( $buttons['bootstrap'] as $button )
                <div class="me-5 mb-3">
                    <button type="button" class="btn btn-rounded btn-outline-{{ $button['name'] }} {{ $button['name'] == "contrast" || $button['name'] == "light" ? " text-primary" : ""  }}">
                        {{ $button['name'] }}
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-utils.container>
