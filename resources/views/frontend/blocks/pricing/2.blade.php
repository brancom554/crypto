<!-- ./Pricing Table - Month/Yearly Plans -->
<x-utils.container class="pricing-table {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="text-center">
        <div class="btn-group pricing-table-basis">
            <input type="radio" class="btn-check" name="pricing-value" id="pricing-value-monthly" value="monthly" autocomplete="off" data-toggle="price" checked>
            <label class="btn btn-outline-primary" for="pricing-value-monthly">Monthly basis</label>

            <input type="radio" class="btn-check" name="pricing-value" id="pricing-value-yearly" value="yearly" autocomplete="off" data-toggle="price">
            <label class="btn btn-outline-primary" for="pricing-value-yearly">Annual basis</label>
        </div>
        <p>(Save up to 30% off on annual plans)</p>
    </div>

    <div class="row">
        @foreach ($plans as $plan)
        <div class="col-md-4 mt-5">
            <div class="card text-center">
                <div class="pricing card-header p-5 d-flex align-items-center flex-column {{ isset($plan['best']) ? 'bg-primary-gradient text-contrast' : 'bg-light-gradient' }}">
                    <h4 class="{{ isset($plan['best']) ? 'text-contrast' : '' }}">{{ $plan['plan']['name'] }}</h4>

                    <div class="pricing-value">
                        <span class="odometer price text-{{ isset($plan['best']) ? "contrast" : "dark" }}"
                            data-monthly="{{ $plan['plan']['price']['monthly'] }}"
                            data-yearly="{{ $plan['plan']['price']['yearly'] }}"
                        >
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
                        class="btn {{ isset($plan['best']) ? 'btn-primary' : 'btn-outline-secondary' }}">
                        Buy now
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-utils.container>
