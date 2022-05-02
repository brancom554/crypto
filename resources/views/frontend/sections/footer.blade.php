@php
    $footer_section = json_decode(\App\Models\Frontend::where('data_keys', 'footer_section')->first(), true)['data_values'];
@endphp
<!-- ./Footer - Four Columns -->
<x-utils.container tag="footer" class="site-footer {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row gap-y text-center @rtl text-md-end @else text-md-start @endrtl">
        <div class="col-md-4 @rtl ms-auto @else me-auto @endrtl">
            <img style="max-height:40px;" src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="favicon"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="" class="logo">

            <p>{!! siteName() !!}, {{ $footer_section['0'] }}</p>
        </div>

        {{-- <div class="col-md-2 @rtl text-end @endrtl">
            <h6 class="py-2 bold text-uppercase">{{ __('locale.Company')}}</h6>

            <nav class="nav flex-column">
                <x-utils.link class="nav-item py-2" :text="__('About')" :href="route('frontend.pages.about')" />
                <x-utils.link class="nav-item py-2" :text="__('Services')" />
                <x-utils.link class="nav-item py-2" :text="__('Blog')" href="blog" />
            </nav>
        </div>

        <div class="col-md-2 @rtl text-end @endrtl">
            <h6 class="py-2 bold text-uppercase">{{ __('locale.Product')}}</h6>

            <nav class="nav flex-column">
                <x-utils.link class="nav-item py-2" :text="__('Features')" />
                <x-utils.link class="nav-item py-2" :text="__('API')" />
                <x-utils.link class="nav-item py-2" href="#" :text="__('Customers')" />
            </nav>
        </div>

        <div class="col-md-2 @rtl text-end @endrtl">
            <h6 class="py-2 bold text-uppercase">{{ __('locale.Channels')}}</h6>

            <nav class="nav flex-column">
                <x-utils.link class="nav-item py-2" :text="__('Careers')" />
                <x-utils.link class="nav-item py-2" :text="__('Contact')" />
                <x-utils.link class="nav-item py-2" :text="__('Search')" />
            </nav>
        </div> --}}
    </div>

    <hr class="mt-5">
    <div class="row small align-items-center">
        <div class="col-md-4">
            <p class="mt-2 mb-md-0 text-secondary text-center @rtl text-md-end @else text-md-start @endrtl">© 2021 {!! siteName() !!}. {{ __('locale.All Rights Reserved')}}</p>
        </div>

        <div class="col-md-8">
            <nav class="nav justify-content-center justify-content-md-end">
                @rtl
                    <x-utils.link class="btn btn-circle btn-sm btn-secondary ms-3 op-4" href="{{ $footer_section['1'] }}" icon="fab fa-facebook" />
                    <x-utils.link class="btn btn-circle btn-sm btn-secondary ms-3 op-4" href="{{ $footer_section['2'] }}" icon="fab fa-twitter" />
                    <x-utils.link class="btn btn-circle btn-sm btn-secondary op-4" href="{{ $footer_section['3'] }}" icon="fab fa-instagram" />
                @else
                    <x-utils.link class="btn btn-circle btn-sm btn-secondary me-3 op-4" href="{{ $footer_section['1'] }}" icon="fab fa-facebook" />
                    <x-utils.link class="btn btn-circle btn-sm btn-secondary me-3 op-4" href="{{ $footer_section['2'] }}" icon="fab fa-twitter" />
                    <x-utils.link class="btn btn-circle btn-sm btn-secondary op-4" href="{{ $footer_section['3'] }}" icon="fab fa-instagram" />
                @endrtl
            </nav>
        </div>
    </div>
</x-utils.container>
