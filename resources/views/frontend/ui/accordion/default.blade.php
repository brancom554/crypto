<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Default</h2>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="accordion" id="accordion-default">
                @foreach ($panels as $panel)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <a href="#" class="card-title btn collapsed" data-bs-toggle="collapse" data-bs-target="#dfl-q{{ $loop->index }}">
                                <i class="fas fa-angle-down angle"></i>{{ $panel['question'] }}
                            </a>
                        </h5>
                    </div>

                    <div id="dfl-q{{ $loop->index }}" class="collapse" data-bs-parent="#accordion-default">
                        <div class="card-body">{{ $panel['answer'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-utils.container>
