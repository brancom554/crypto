<!-- ./Footer - Five Columns -->
<x-utils.container tag="footer" class="site-footer bg-darker text-contrast {{ $class  ?? '' }}" container-class="{{ $containerClass  ?? '' }}">
    <div class="row gap-y text-center @rtl text-md-end @else text-md-start @endrtl">
        <div class="col-md-4 @rtl ms-auto @else me-auto @endrtl">
            <img src="{{ asset('img/logo-light.png') }}" alt="" class="logo">

            <p>{{ appName() }}, @Lang("a carefully crafted and powerful HTML5 template, it's perfect to showcase your startup or software")</p>
        </div>

        <div class="col-md-2">
            <h6 class="bold py-2 text-contrast text-uppercase">@Lang('Company')</h6>
            <nav class="nav flex-column">
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('About')" :href="route('frontend.pages.about')" />
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('Services')" />
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('Blog')" />
            </nav>
        </div>

        <div class="col-md-2">
            <h6 class="bold py-2 text-contrast text-uppercase">@Lang('Features')</h6>
            <nav class="nav flex-column">
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('Features')" />
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('API')" />
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('Customers')" />
            </nav>
        </div>

        <div class="col-md-2">
            <h6 class="bold py-2 text-contrast text-uppercase">Resources</h6>
            <nav class="nav flex-column">
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('Careers')" />
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('Contact')" />
                <x-utils.link class="nav-item py-2 text-contrast" :text="__('Search')" />
            </nav>
        </div>

        <div class="col-md-2">
            <h6 class="bold py-2 text-contrast text-uppercase @rtl text-md-start @else text-md-end @endrtl">@Lang('Follow us')</h6>

            <nav class="nav justify-content-end">
                @rtl
                    <x-utils.link class="btn btn-circle btn-sm btn-light ms-2" icon="fab fa-facebook font-regular" />
                    <x-utils.link class="btn btn-circle btn-sm btn-light ms-2" icon="fab fa-twitter font-regular" />
                    <x-utils.link class="btn btn-circle btn-sm btn-light" icon="fab fa-instagram font-regular" />
                @else
                    <x-utils.link class="btn btn-circle btn-sm btn-light me-2" icon="fab fa-facebook font-regular" />
                    <x-utils.link class="btn btn-circle btn-sm btn-light me-2" icon="fab fa-twitter font-regular" />
                    <x-utils.link class="btn btn-circle btn-sm btn-light" icon="fab fa-instagram font-regular" />
                @endrtl
            </nav>
        </div>
    </div>

    <hr class="mt-5 bg-secondary op-5">
    <div class="row small align-items-center">
        <div class="col-md-4">
            <p class="mt-2 mb-0">© 2021 5studios. @Lang('All Rights Reserved')</p>
        </div>
    </div>
</x-utils.container>
