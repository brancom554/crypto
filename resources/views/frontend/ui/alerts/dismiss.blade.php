<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Dismissing</h2>
            <p class="lead italic">Using the alert JavaScript plugin, it’s possible to dismiss any alert inline.</p>
        </div>

        <div class="row gap-y">
            <div class="col-md-8 mx-auto">
                @foreach ($alerts['bootstrap'] as $alert)
                    <div class="alert alert-{{ $alert }} alert-dismissible fade show" role="alert">
                        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        </div>
</x-utils.container>
