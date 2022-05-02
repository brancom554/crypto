<!-- ./Pricing Table -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row">
        <div class="col-sm-4">
            <h2>Affordable <span class="bold d-block">pricing plans</span></h2>
            <p>Because every company is different, DashCore comes with multiple licensing plans that fit your needs.</p>

            <hr class="my-5">
            <p class="handwritten font-md">Not want you need?</p>
            <p>If you are looking for additional advanced features not listed here, drop us a line.</p>
            <button class="btn btn-outline-info btn-rounded ms-0">
                <i class="far fa-envelope me-3"></i>
                Contact us
            </button>
        </div>

        @for ($i = 0; $i < 2; $i++)
        @php ($plan = $plans[$i])
        <div class="col-sm-4">
            <div class="card shadow {{ isset($plan['best']) ? "border" : "" }}">
                <div class="card-body p-5">
                    <h4 class="{{ isset($plan['best']) ? 'text-primary' : '' }}">
                        <span class="bold">{{ $plan['plan']['name'] }}</span> plan
                    </h4>
                    <p class="py-1 {{ isset($plan['best']) ? 'px-3 bg-primary text-contrast bold rounded-pill' : '' }}">
                        {{ $plan['plan']['description'] }}
                    </p>

                    <div class="pricing text-center">
                        <p class="pricing-value mb-4">
                            <span class="price text-dark">{{ $plan['plan']['price']['monthly'] }}</span>
                        </p>

                        <a href="#"
                            class="btn btn-rounded {{ isset($plan['best']) ? 'btn-primary' : 'btn-outline-primary' }}">I
                            want this</a>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($plan['features'] as $feature)
                    <li class="list-group-item {{ $feature['class'] ?? '' }}">{{ $feature['name'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endfor
    </div>
</x-utils.container>
