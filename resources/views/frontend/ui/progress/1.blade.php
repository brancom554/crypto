<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2>Basic</h2>
        <p class="lead">Progress components are built with two HTML elements, some CSS to set the width, and a few attributes. We don’t use the HTML5 <code>&lt;progress&gt;</code> element, ensuring you can stack progress bars, animate them, and place text labels over them.</p>
    </div>

    <div class="row gap-y">
        <div class="col-md-8 mx-auto">
            @foreach ($bars as $bar)
                <div class="progress {{ $loop->index <= $loop->count ? "mt-3" : "" }}">
                    <div class="progress-bar" style="width: {{ $bar['value'] }}%"></div>
                </div>
            @endforeach
        </div>
    </div>
</x-utils.container>
