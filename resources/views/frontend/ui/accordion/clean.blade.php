<!-- Accordion Clean  -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Accordion Clean</h2>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="accordion accordion-clean" id="accordion-light">
                @foreach ($panels as $panel)
                <div class="card mb-3">
                    <div class="card-header">
                        <a href="#" class="card-title btn collapsed" data-bs-toggle="collapse" data-bs-target="#lgt-q{{ $loop->index }}">
                            <i class="fas fa-angle-down angle"></i>{{ $panel['question'] }}
                        </a>
                    </div>

                    <div id="lgt-q{{ $loop->index }}" class="collapse" data-bs-parent="#accordion-light">
                        <div class="card-body">{{ $panel['answer'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-utils.container>
