<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Circle</h2>
        <p class="lead italic">Bootstrap includes several predefined button styles, each serving its own semantic purpose,
            with a few extras thrown in for more control.</p>
    </div>

    <div class="bootstrap">
        <div class="row gap-y">
            <div class="col-12 d-flex flex-wrap justify-content-around">
                @foreach ( $buttons['bootstrap'] as $button )
                <button type="button" class="btn btn-circle btn-{{ $button['name'] }}"><i
                        class="far fa-comment"></i></button>
                @endforeach
            </div>

            <div class="col-12 d-flex flex-wrap justify-content-around">
                @foreach ( $buttons['bootstrap'] as $button )
                <button type="button" class="btn btn-circle btn-outline-{{ $button['name'] }} {{ $button['name'] == "contrast" || $button['name'] == "light" ? " text-primary" : "" }}">
                    <i class="far fa-comment"></i>
                </button>
                @endforeach
            </div>
        </div>
    </div>
</x-utils.container>
