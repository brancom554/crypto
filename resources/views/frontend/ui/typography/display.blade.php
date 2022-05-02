<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Display headings</h2>
        <p class="lead italic">Traditional heading elements are designed to work best in the meat of your page content. When you need a heading to stand out, consider using a <span class="bold">display heading</span>—a larger, slightly more opinionated heading style.</p>
    </div>

    @for ($i = 1; $i < 6; $i++)
        <p class="text-dark display-{{ $i }}">Display {{ $i }}</p>
    @endfor
</x-utils.container>
