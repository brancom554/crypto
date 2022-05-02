<!-- ./Accordion - Collapsed -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Accordion Collapsed</h2>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p class="b-b pb-2 mb-5 text-primary bold">Collapsed Default</p>
            <div class="accordion accordion-collapsed" id="accordion-collapsed">
                @foreach ( $panels as $panel)
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="card-title btn" data-bs-toggle="collapse" data-bs-target="#clp-q{{ $loop->index }}">
                            <i class="fas fa-angle-down angle"></i>{{ $panel['question'] }}
                        </a>
                    </div>

                    <div id="clp-q{{ $loop->index }}" class="collapse" data-bs-parent="#accordion-collapsed">
                        <div class="card-body">{{ $panel['answer'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <p class="b-b pb-2 mb-5 text-primary bold">Collapsed Clean</p>
            <div class="accordion accordion-clean accordion-collapsed" id="accordion-collapsed-clean">
                @foreach ($panels as $panel)
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="card-title btn" data-bs-toggle="collapse" data-bs-target="#lgt-clp-q{{ $loop->index }}">
                            <i class="fas fa-angle-down angle"></i>{{ $panel['question'] }}
                        </a>
                    </div>

                    <div id="lgt-clp-q{{ $loop->index }}" class="collapse" data-bs-parent="#accordion-collapsed-clean">
                        <div class="card-body">{{ $panel['answer'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-utils.container>
