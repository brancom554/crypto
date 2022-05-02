<!-- ./Footer - Headline -->
<x-utils.container tag="footer" class="site-footer bg-darker text-contrast text-center {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <img src="{{ asset('img/logo-light.png') }}" alt="" class="logo">

    <p class="lead mt-5">Don't wait - <span class="bold">Get {{ appName() }}</span> NOW!</p>

    <p class="copyright my-5">
        © 2021 {{ appName() }}, <em>by</em> <a class="brand bold" href="https://www.5studios.net" target="_blank">5Studios.net</a>
    </p>

    <hr class="mt-5 bg-secondary op-5">
    <nav class="nav social-icons justify-content-center mt-4">
        @rtl
            <x-utils.link class="btn text-contrast btn-circle btn-sm brand-facebook ms-3" icon="fab fa-facebook" />
            <x-utils.link class="btn text-contrast btn-circle btn-sm brand-twitter ms-3" icon="fab fa-twitter" />
            <x-utils.link class="btn text-contrast btn-circle btn-sm brand-youtube ms-3" icon="fab fa-youtube" />
            <x-utils.link class="btn text-contrast btn-circle btn-sm brand-pinterest" icon="fab fa-pinterest" />
        @else
            <x-utils.link class="btn text-contrast btn-circle btn-sm brand-facebook me-3" icon="fab fa-facebook" />
            <x-utils.link class="btn text-contrast btn-circle btn-sm brand-twitter me-3" icon="fab fa-twitter" />
            <x-utils.link class="btn text-contrast btn-circle btn-sm brand-youtube me-3" icon="fab fa-youtube" />
            <x-utils.link class="btn text-contrast btn-circle btn-sm brand-pinterest" icon="fab fa-pinterest" />
        @endrtl
    </nav>
</x-utils.container>
