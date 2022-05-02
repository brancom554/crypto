<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2>Style</h2>
        <p class="lead">Use any color variation from the <a href="ui-colors">colors</a> available.</p>
    </div>

    <div class="row gap-y">
        <div class="col-md-8 mx-auto">
            @foreach ($bars as $bar)
                <div class="progress progress-sm {{ $bar['style'] }} {{ $loop->index <= $loop->count ? "mt-3" : "" }}">
                    <div class="progress-bar" style="width: {{ $bar['value'] }}%"></div>
                </div>
            @endforeach
        </div>
    </div>
</x-utils.container>
