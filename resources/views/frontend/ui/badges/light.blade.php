<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Light badges</h2>
        <p class="lead italic">Some colors are better seen on dark backgrounds, those are the ones with light colors.</p>
    </div>

    <div class="d-flex flex-wrap justify-content-around bg-dark py-5">
        <span class="badge bg-contrast text-dark">badge-contrast</span>
        <span class="badge badge-outline-contrast">badge-outline-contrast</span>
        <span class="badge bg-light text-dark">badge-light</span>
        <span class="badge badge-outline-light">badge-outline-light</span>
    </div>
</x-utils.container>
