<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Scaling</h2>
            <p class="lead italic">Badges scale to match the size of the immediate parent element by using relative font sizing and <code>em</code> units.</p>
        </div>

        <h1>Example heading <span class="badge bg-primary">New</span></h1>
        <h2>Example heading <span class="badge bg-primary">New</span></h2>
        <h3>Example heading <span class="badge bg-primary">New</span></h3>
        <h4>Example heading <span class="badge bg-primary">New</span></h4>
        <h5>Example heading <span class="badge bg-primary">New</span></h5>
        <h6>Example heading <span class="badge bg-primary">New</span></h6>
</x-utils.container>
