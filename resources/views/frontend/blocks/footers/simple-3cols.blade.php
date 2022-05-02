<!-- ./Footer - Simple -->
<x-utils.container tag="footer" class="site-footer {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row align-items-center">
        <div class="col-md-5 text-center text-md-left">
            <nav class="nav justify-content-center justify-content-md-start">
                <x-utils.link class="nav-item nav-link" :text="__('About')" :href="route('frontend.pages.about')" />
                <x-utils.link class="nav-item nav-link" :text="__('Services')" />
                <x-utils.link class="nav-item nav-link" :text="__('Blog')" href="blog-grid" />
            </nav>
        </div>

        <div class="col-md-2 text-center">
            <img src="{{ asset('img/logo.png') }}" alt="" class="logo">
        </div>

        <div class="col-md-5 text-center text-md-right">
            <p class="mt-2 mb-0 text-secondary small">© 2021 5studios. @Lang('All Rights Reserved')</p>
        </div>
    </div>
</x-utils.container>
