<!-- ./Register Trial Form -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="row align-items-center">
            <div class="col-md-7 order-md-2">
                <div class="device browser shadow" data-aos="fade-left">
                    <div class="screen">
                        <img src="{{ asset('img/screens/dash/1.png') }}" class="img-responsive" alt="...">
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <h4 class="text-uppercase">@Lang('Start your free trial today')</h4>
                <p class="text-secondary">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, consequatur
                    dignissimos esse illo in non odit porro quaerat quisquam temporibus.
                </p>

                <x-forms.register-trial />
            </div>
        </div>
</x-utils.container>
