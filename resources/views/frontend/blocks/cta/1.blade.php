<!-- ./CTA - Create Account -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="d-flex align-items-center flex-column flex-md-row">
        <div class="text-center @rtl text-md-end @else text-md-start @endrtl">
            <p class="light mb-0 text-primary lead">Ready to get started?</p>
            <h2 class="mt-0 bold">Create an account now</h2>
        </div>

        <a href="{{ route('frontend.auth.register') }}" class="btn btn-primary btn-rounded mt-3 mt-md-0 @rtl me-md-auto @else ms-md-auto @endrtl">
            Create DashCore account
        </a>
    </div>
</x-utils.container>
