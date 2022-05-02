<!-- ./Pricing Table - Simple Columns -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row">
        @foreach ($plans as $plan)
        <div class="col-md-4 mt-5">
            <div class="card text-center">
                <div class="pricing card-header p-5 d-flex align-items-center flex-column {{ isset($plan['best']) ? "bg-primary text-contrast" : "bg-light" }}">
                    <h4 class="bold {{ isset($plan['best']) ? 'text-contrast' : '' }}">{{ $plan['plan']['name'] }}</h4>

                    <div class="pricing-value">
                        <span class="price text-{{ isset($plan['best']) ? "contrast" : "dark" }}">
                            {{ $plan['plan']['price']['monthly'] }}
                        </span>
                    </div>

                    <p>{{ $plan['plan']['description'] }}</p>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($plan['features'] as $feature)
                        <li class="list-group-item {{ $feature['class'] ?? '' }}">{{ $feature['name'] }}</li>
                    @endforeach
                </ul>

                <div class="card-body">
                    <a href="javascript:;"
                        class="btn btn-rounded {{ isset($plan['best']) ? 'btn-primary' : 'btn-outline-primary' }}">
                        @Lang('Buy now')
                        <i class="fa fa-long-arrow-alt-right ms-3"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-utils.container>
