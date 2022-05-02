<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}" id="colors-gradient">
    <div class="section-heading text-center">
        <h2 class="bold">Gradients</h2>
        <p class="lead italic">You can opt to use gradients background by adding <code>.gradient</code> to any element.</p>
    </div>

    <p class="small text-center bold text-dark">The following are predefined variations, you can of course define your own variations by changing the SASS files.</p>

    <div class="row gap-y">
        @foreach ($colors['gradients'] as $gradient)
            @foreach ($gradient['variants'] as $variant)
                <div class="col-6 col-lg-4">
                    <div class="gradient gradient-{{ $gradient['base'] }}-{{ $variant }} text-contrast lead p-4">.gradient-{{ $gradient['base'] }}-{{ $variant }}</div>
                </div>
            @endforeach
        @endforeach
    </div>
</x-utils.container>
