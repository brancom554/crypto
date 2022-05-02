<!-- ./Footer - Stay in Touch -->
<x-utils.container tag="footer" class="site-footer text-center {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="mb-4">
        <i data-feather="mail" width="36" height="36" class="stroke-primary"></i>
        <h2 class="bold mb-0">@Lang('Stay updated')</h2>
    </div>

    <p class="lead text-secondary mb-5">@Lang('By registering with us you will receive right in your inbox all new features and updates')</p>

    <div class="row">
        <div class="col-12 col-md-6 mx-auto overflow-hidden">
            <x-forms.register-input-group />
        </div>
    </div>

    <hr class="mt-5">
    <nav class="nav social-icons justify-content-center mt-4">
        @rtl
            <x-utils.link class="ms-3 font-regular text-secondary" icon="fab fa-facebook" />
            <x-utils.link class="ms-3 font-regular text-secondary" icon="fab fa-twitter" />
            <x-utils.link class="ms-3 font-regular text-secondary" icon="fab fa-instagram" />
            <x-utils.link class="font-regular text-secondary" icon="fab fa-linkedin-in" />
        @else
            <x-utils.link class="me-3 font-regular text-secondary" icon="fab fa-facebook" />
            <x-utils.link class="me-3 font-regular text-secondary" icon="fab fa-twitter" />
            <x-utils.link class="me-3 font-regular text-secondary" icon="fab fa-instagram" />
            <x-utils.link class="font-regular text-secondary" icon="fab fa-linkedin-in" />
        @endrtl
    </nav>

    <p class="small copyright text-secondary">© 2021 {{ appName() }}, <em>by</em>
        <a class="brand bold" href="http://www.5studios.net">5Studios.net</a>
    </p>
</x-utils.container>
