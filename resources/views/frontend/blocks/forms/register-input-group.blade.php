<!-- ./Newsletter Form -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row">
        <div class="col-md-6 b-md-r">
            <h2>DashCore <span class="bold">official Newsletter</span></h2>
        </div>

        <div class="col-md-5 ms-md-auto">
            <x-forms.register-input-group />
        </div>
    </div>
</x-utils.container>
