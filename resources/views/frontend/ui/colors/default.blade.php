<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Background color</h2>
        <p class="lead italic">Easily set the background of an element to any contextual class. Anchor components will
            darken on hover, just like the text classes. Background utilities <span class="bold">do not set</span>
            <code>color</code>, so in some cases you’ll want to use <code>.text-*</code> utilities.</p>
    </div>

    <p class="b-b pb-2 mb-5 text-secondary">Bootstrap default</p>
    <div class="row gap-y">
        @foreach ($colors["bootstrap"] as $color)
        <div class="col-6 col-lg-4">
            <div class="bg-{{ $color['name'] }} text-{{ $color['text'] }} lead p-4">.bg-{{ $color['name'] }}</div>
        </div>
        @endforeach
    </div>
</x-utils.container>
