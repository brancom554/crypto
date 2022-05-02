<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Overlay</h2>
        <p class="lead italic">Easily add an overlay to any element by including <code>.overlay</code> class.</p>
    </div>

    <div class="accordion accordion-clean" id="accordion-overlay">
        @foreach ($overlays as $o)
        <div class="card card-clean mb-3">
            <div class="card-header">
                <a href="#" class="card-title text-uppercase btn{{ $loop->index > 0 ? " collapsed" : "" }}" data-bs-toggle="collapse" data-bs-target="#overlay-{{ $o['name'] }}">
                    <i class="fas fa-angle-down angle"></i>{{ $o['name'] }}
                </a>
            </div>

            <div id="overlay-{{ $o['name'] }}" class="collapse{{ $loop->index == 0 ? " show" : "" }}" data-bs-parent="#accordion-overlay">
                <div class="card-body">
                    <code class="text-center bold d-block mb-3 mt-4">.overlay-{{ $o['name'] }}</code>
                    <div class="row gap-y">
                        @for ($a = 0; $a < 11; $a++)
                            <div class="col-md-4">
                                <div class="shadow-box image-background cover overlay overlay-{{ $o['name'] }} alpha-{{ $a }}" style="background-image: url(https://picsum.photos/350/200/?random)">
                                    <div class="content px-3 py-6">
                                        <h6 class="text-{{ $o['color'] }} text-center">Overlay text</h6>
                                    </div>
                                </div>
                                <p class="small text-center mt-2">.alpha-{{ $a }}</p>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-utils.container>
