@php($plans = [
    [ "name" => "Free", "description" => "For individuals", "price" => [ "monthly" => 0, "yearly" => 0 ] ],
    [ "name" => "Starter", "description" => "For small business", "price" => [ "monthly" => 24, "yearly" => 19 ], "class" => "visible-cell", "best" => true ],
    [ "name" => "Power", "description" => "For large companies", "price" => [ "monthly" => 99, "yearly" => 79 ] ]
])

@php($groups = [
    [
        "items" => [
            [ "label" => "Always-on recording", "plans" => [[ "icon" => 'fas fa-times text-danger' ], [ "icon" => 'fas fa-check text-success' ], [ "icon" => 'fas fa-check text-success' ]] ],
            [ "label" => "Events", "plans" => ['2', '2', 'Unlimited'] ],
            [ "label" => "Funnels", "plans" => ['1', '1', 'Unlimited'] ],
            [ "label" => "Heatmaps", "plans" => ['3', 'Unlimited', 'Unlimited'] ],
            [ "label" => "Sessions/month", "plans" => ['1,500', [ "list" => ['5000', [ "value" => 25000, "label" =>  '25,000' ], [ "value" => 50000, "label" => '50,000' ]], "input" => [ "id" => 'sessions_starter' ] ], [ "list" => [[ "value" => 25000, "label" => '25,000' ], [ "value" => 50000, "label" => '50,000' ], [ "value" => 100000, "label" => '100,000' ]], "input" => [ "id" => 'sessions_power' ] ] ] ],
            [ "label" => "Data history", "plans" => ['1 month', [ "list" => [[ "value" => 1, "label" => '1 month' ], [ "value" => 3, "label" => '3 months' ]], "input" => [ "id" => 'data_starter' ] ], [ "list" => [[ "value" => 1, "label" => '1 month' ], [ "value" => 3, "label" => '3 months' ], [ "value" => 6, "label" => '6 months' ], [ "value" => 12, "label" => '12 months' ]], "input" => [ "id" => 'data_power' ] ] ] ],
        ]
    ]
])

<x-utils.container class="pricing-table {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <div class="btn-group btn-group-toggle mt-5 pricing-table-basis">
            <input type="radio" class="btn-check" name="pricing-basis" id="pricing-table-value-monthly" value="monthly" autocomplete="off" data-toggle="price" checked>
            <label class="btn btn-outline-primary" for="pricing-table-value-monthly">Monthly</label>

            <input type="radio" class="btn-check" name="pricing-basis" id="pricing-table-value-yearly" value="yearly" autocomplete="off" data-toggle="price">
            <label class="btn btn-outline-primary" for="pricing-table-value-yearly">Yearly</label>
        </div>

        <p class="text-muted">Pay annually and get 2 months free</p>
    </div>

    <div class="pricing-table-table">
        <div class="d-md-none">
            <div class="btn-group pricing-table-tabs mb-3">
                @foreach ($plans as $plan)
                    <input type="radio" class="btn-check" name="pricing-plan" id="pricing-plan-{{ $loop->index }}" value="{{ $loop->index }}" {{ $loop->index == 1 ? "checked" : "" }}>
                    <label class="btn btn-primary" for="pricing-plan-{{ $loop->index }}">{{ $plan['name'] }}</label>
                @endforeach
            </div>
        </div>

        <div class="table-wrapper">
            <table class="table">
                <thead class="expand-mobile">
                    <tr>
                        <th class="title @rtl text-right @else text-left @endrtl"><span class="hidden bold">Choose Your Plan</span></th>
                        @foreach ($plans as $plan)
                            <th id="ph-{{ $loop->index }}" class="{{ $plan['class'] ?? "" }}{{ isset($plan['best']) ? " overflow-hidden position-relative" : "" }}">
                                <p class="h4 pricing-title bold my-0">{{ $plan['name'] }}</p>
                                <p class="my-0">{{ $plan['description'] }}</p>
                            </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="pricing-details">
                <tr>
                    <th><span>Monthly price</span></th>
                    @foreach($plans as $plan)
                        <td headers="ph-{{ $loop->index }}" class="{{ $plan['class'] ?? "" }}">
                            <div class="pricing">
                                <span class="pricing-value">
                                    <span class="odometer price text-dark"
                                          data-monthly="{{ $plan['price']['monthly'] }}"
                                          data-yearly="{{ $plan['price']['yearly'] }}"
                                    >
                                        {{ $plan['price']['monthly'] }}
                                    </span>
                                </span>
                            </div>
                        </td>
                    @endforeach
                </tr>
                </tbody>

                @foreach ($groups as $group)
                    @if ( isset( $group['name'] ) )
                        <tr>
                            <th colspan="4">
                                <span class="pricing-title heading bold text-uppercase">{{ $group['name'] }}</span>
                            </th>
                        </tr>
                    @endif

                    <tbody class="pricing-details">
                    @foreach ( $group['items'] as $item )
                        @php( $pc = "pc-{$loop->index}" )
                        <tr>
                            <th id="{{ $pc }}">{{ $item['label'] }}</th>
                            @foreach ( $item['plans'] as $plan )
                                <td headers="ph-{{ $loop->index }} {{ $pc }}" class="{{ $loop->index == 2 ? "visible-cell" : "" }}">
                                    @if ( isset( $plan['icon'] ) )
                                        <i class="{{ $plan['icon'] }}"></i>
                                    @elseif ( isset($plan['list']) )
                                        <select name="{{ $plan['input']['id'] }}" id="{{ $plan['input']['id'] }}" class="form-select" data-toggle="price">
                                            @foreach ( $plan['list'] as $option )
                                                <option value="{{ isset($option['value']) ? $option['value'] : $option }}">{{ isset($option['label']) ? $option["label"] : $option }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        {{ $plan }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                @endforeach

                <tbody class="expand-mobile">
                <tr>
                    <td class="@rtl text-end @else text-start @endrtl">Prices don't include tax.</td>
                    @foreach ($plans as $plan)
                        <td headers="ph-{{ $loop->index }} {{ $pc }}" class="{{ $loop->index == 2 ? "visible-cell" : "" }}">
                            <a href="javascript:;" class="btn btn-rounded btn-primary">Get {{ $plan['name'] }} Plan</a>
                        </td>
                    @endforeach
                </tr>
                </tbody>

                <tfoot>
                <tr>
                    <td colspan="4">
                        <p class="pricing-disclaimer">
                            <span class="bold">15-day money-back guarantee.</span>
                            <span>If you're not 100% satisfied, we'll give your money back.</span>
                        </p>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-utils.container>
