<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>

<script src="{{asset(mix('vendors/bower/jquery.sticky/jquery.sticky.js'))}}"></script>
@yield('vendor-script')

<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

@if(Request::is('admin**'))
    @include('admin.partials.notify')
@else
    @include('partials.plugins')
    @include('admin.partials.notify')
@endif

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif

<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->

@yield('page-script')
@stack('script-lib')
@stack('script')
@stack('modals')

<!-- END: Page JS-->

@livewireScripts
<script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
