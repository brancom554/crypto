<x-frontend.navbar class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <ul class="nav navbar-nav @rtl ms-auto @else me-auto @endrtl">
        <li class="nav-item"><a class="nav-link" href="javascript:;">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="javascript:;">Pricing</a></li>
        <li class="nav-item"><a class="nav-link" href="javascript:;">Download</a></li>
        <li class="nav-item"><a class="nav-link" href="javascript:;">Blog</a></li>
    </ul>

    <nav class="nav navbar-nav @rtl me-md-auto @else ms-md-auto @endrtl justify-content-center mt-4 mt-md-0 flex-row">
        <a class="btn btn-rounded btn-outline-primary @rtl ms-3 @else me-3 @endrtl px-3" href="javascript:;" target="_blank">
            <i class="fas fa-sign-in-alt d-none d-md-inline @rtl ms-md-0 ms-lg-2 @else me-md-0 me-lg-2 @endrtl"></i>
            <span class="d-md-none d-lg-inline">@Lang('Login')</span>
        </a>
        <a class="btn btn-rounded btn-primary px-3" href="javascript:;" target="_blank">
            <i class="fas fa-user-plus d-none d-md-inline @rtl ms-md-0 ms-lg-2 @else me-md-0 me-lg-2 @endrtl"></i>
            <span class="d-md-none d-lg-inline">@Lang('Signup')</span>
        </a>
    </nav>
</x-frontend.navbar>
