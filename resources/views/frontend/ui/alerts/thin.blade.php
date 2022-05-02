<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Alert thin</h2>
            <p class="lead italic">Alerts are available for any length of text, as well as an optional dismiss button. For proper styling, use one of the eight required contextual classes (e.g., <code>.alert-success</code>). For inline dismissal, use the alerts jQuery plugin.</p>
        </div>

        <div class="row gap-y">
            <div class="col-md-8 mx-auto">
                @foreach ($alerts['bootstrap'] as $alert)
                    <div class="alert alert-{{ $alert }} alert-thin" role="alert">
                        A simple {{ $alert }} alert—check it out!
                    </div>
                @endforeach
            </div>
        </div>
</x-utils.container>
