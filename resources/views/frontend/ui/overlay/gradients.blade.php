<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Gradients</h2>
        <p class="lead italic">You can opt to use gradients overlay by adding <code>.gradient</code> to any element.</p>
    </div>

    <p class="small text-center bold text-dark">The bellow sample uses <code>.gradient-blue-purple</code> css class to demonstrate how to used it.</p>
    <p class="text-secondary text-center">you can view all gradient variations <a href="ui-colors#colors-gradient" target="_blank">here</a></p>

    <div class="row gap-y">
        @for ($a = 0; $a < 11; $a++)
        <div class="col-md-4">
            <div class="shadow-box image-background cover overlay gradient gradient-blue-purple alpha-{{ $a }}"
                style="background-image: url(https://picsum.photos/350/200/?random)">
                <div class="content px-3 py-6">
                    <h6 class="text-contrast text-center">Overlay text</h6>
                </div>
            </div>
            <p class="text-center mt-3"><code>.alpha-{{ $a }}</code></p>
        </div>
        @endfor
    </div>
</x-utils.container>
