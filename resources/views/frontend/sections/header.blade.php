@php ($useDarkLinks = $useDarkLinks ?? false)
@php ($fixedTop = $fixedTop ?? true)

<nav class="navigation main-nav navbar navbar-expand-lg sidebar-left{{ $fixedTop ? ' fixed-top' : '' }}{{ $useDarkLinks ? ' dark-link' : '' }}">
    <div class="container">
        <button class="navbar-toggler" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <x-utils.link href="#main" class="navbar-brand">
            <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" class="logo logo-sticky">
        </x-utils.link>

        <div class="collapse navbar-collapse ms-auto" id="main-navbar">
            <div class="sidebar-brand">
                <x-utils.link :href="route('home')">
                    <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" class="logo">
                </x-utils.link>
            </div>

            <ul class="nav navbar-nav">
                <li class="nav-item"><x-utils.link class="nav-link" :href="route('home')">Home</x-utils.link></li>
                <li class="nav-item"><x-utils.link class="nav-link" :href="route('blogetc.index')">Blog</x-utils.link></li>
            </ul>

            <nav class="nav navbar-nav ms-auto justify-content-end mt-4 mt-md-0 flex-row">
                @guest
                    <x-utils.link
                        :href="route('login')"
                        :active="activeClass(Route::is('login'))"
                        class="btn rounded-pill btn-outline me-3 px-3"
                    >
                        <x-slot name="text">
                            <i class="fas fa-sign-in-alt d-none d-md-inline me-md-0 me-lg-2"></i>
                            <span class="d-md-none d-lg-inline">Login</span>
                        </x-slot>
                    </x-utils.link>

                    @if (config('template.access.user.registration'))
                        <x-utils.link
                            :href="route('register')"
                            :active="activeClass(Route::is('register'))"
                            class="btn rounded-pill btn-solid px-3"
                        >
                            <x-slot name="text">
                                <i class="fas fa-user-plus d-none d-md-inline me-md-0 me-lg-2"></i>
                                <span class="d-md-none d-lg-inline">Signup</span>
                            </x-slot>
                        </x-utils.link>
                    @endif
                @else
                <x-utils.link class="nav-link d-flex align-items-center" role="button" :href="route('login')">
                    <img class="rounded-circle me-2" style="max-height: 40px"
                        src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('images/portrait/small/avatar-s-11.jpg') }}" />
                </x-utils.link>
                @endguest
            </nav>
        </div>
    </div>
</nav>
