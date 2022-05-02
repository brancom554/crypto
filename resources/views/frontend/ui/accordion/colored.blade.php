<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Colored</h2>
        <p class="lead italic">Fancy colored accordion? <br>
            Add <code>.accordion-[primary|secondary|success|danger|warning|info|light|dark]</code> to color the accordion.
        </p>

        <div class="dropdown" id="demo-accordion-theme-selector">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" id="accordion-theme-current">
                Info
            </button>

            <div class="dropdown-menu" id="colors">
                <a class="dropdown-item" href="#" data-color="primary">Primary</a>
                <a class="dropdown-item" href="#" data-color="secondary">Secondary</a>
                <a class="dropdown-item" href="#" data-color="success">Success</a>
                <a class="dropdown-item" href="#" data-color="danger">Danger</a>
                <a class="dropdown-item" href="#" data-color="warning">Warning</a>
                <a class="dropdown-item" href="#" data-color="info">Info</a>
                <a class="dropdown-item" href="#" data-color="light">Light</a>
                <a class="dropdown-item" href="#" data-color="dark">Dark</a>
                <a class="dropdown-item" href="#" data-color="alternate">Alternate</a>
                <a class="dropdown-item" href="#" data-color="contrast">Contrast</a>
                <a class="dropdown-item" href="#" data-color="darker">Darker</a>
                <a class="dropdown-item" href="#" data-color="black">Black</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="accordion" id="accordion-colored" data-bs-current="info">
                @foreach ($panels as $panel)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <a href="#" class="card-title btn" data-bs-toggle="collapse" data-bs-target="#clr-q{{ $loop->index }}">
                                <i class="fas fa-angle-down angle"></i>{{ $panel['question'] }}
                            </a>
                        </h5>
                    </div>

                    <div id="clr-q{{ $loop->index }}" class="collapse" data-bs-parent="#accordion-colored">
                        <div class="card-body">{{ $panel['answer'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-utils.container>
