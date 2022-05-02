<!-- Smart Wallet -->
<section class="section smart-wallet">
    <div class="shapes-container">
        <div class="shape pattern pattern-dots"></div>
    </div>

    <div class="container">
        <div class="row gap-y align-items-center">
            <div class="col-md-6">
                <div class="section-heading">
                    <h2 class="heading-line bold"><span class="light">{{ $wallets_section['0'] }}</span> <br>{{ $wallets_section['1'] }}</h2>
                    <p class="lead">{{ $wallets_section['2'] }}</p>
                </div>

                <p class="mb-5">{{ $wallets_section['3'] }}</p>

                <a href="/login" class="btn btn-rounded btn-outline-darker">{{ $wallets_section['4'] }}</a>
            </div>

            <div class="col-md-6">
                <div class="card shadow bg-dark no-action mx-auto wallet">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <img src="{{ asset("img/avatar/1.jpg") }}" class="icon-md rounded-circle" alt="">
                        <span class="text-uppercase small bold">my transactions</span>
                        <i data-feather="bell"></i>
                    </div>

                    <div class="card-body">
                        <span class="small">Available Balance</span>
                        <p class="h2 mt-0 text-contrast">$ <span class="counter">1,485.21</span></p>
                    </div>

                    <div class="card-body">
                        <button class="btn btn-primary">Pay</button>
                        <button class="btn btn-contrast">Request</button>
                    </div>

                    <div class="card card-details bg-contrast" data-aos="fade-up">
                        <div class="card-body pb-0 d-flex align-items-center justify-content-between">
                            <h6 class="m-0 bold">My Transactions</h6>
                            <button class="btn btn-primary btn-sm"><i class="fas fa-sliders-h"></i></button>
                        </div>

                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @php($transactions = [
                                    ["name" => 'Bitcoin', "date" => "Today", "amount" => "35.45", "sign" => "+", "icon" => "cast"],
                                    ["name" => 'Litecoin', "date" => "Today", "amount" => "5.45", "sign" => "-", "icon" => "coffee"],
                                    ["name" => 'Dogecoin', "date" => "Yesterday", "amount" => "135.45", "sign" => "+", "picture" => "2"],
                                    ["name" => 'Bitcoin', "date" => "3rd May, 2020", "amount" => "178.95", "sign" => "+", "icon" => "shopping-bag"]
                                ])
                                @foreach ($transactions as $transaction)
                                    <div class="list-group-item px-0">
                                        <div class="d-flex justify-content-between mb-0">
                                            <div class="d-flex">
                                                <div class="icon-md bg-primary p-2 rounded-circle center-flex @rtl ms-3 @else me-3 @endrtl">
                                                    @if (isset($transaction['icon']))
                                                    <i data-feather="{{ $transaction['icon'] }}" class="stroke-contrast"></i>
                                                    @else
                                                    <img src="{{ asset("img/avatar/{$transaction['picture']}.jpg") }}" class="icon-md rounded-circle" alt="">
                                                    @endif
                                                </div>

                                                <div class="flex-fill">
                                                    <p class="my-0 bold font-sm">{{ $transaction['name'] }}</p>
                                                    <p class="my-0 small text-muted">{{ $transaction['date'] }}</p>
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <p class="my-0 bold font-sm">{{ $transaction['sign'] }}${{ $transaction['amount'] }}</p>
                                                <p class="my-0 small @if($transaction['sign'] == "-") text-danger @else text-success @endif">
                                                    @if($transaction['sign'] == "-") {{ $wallets_section['5'] }} @else {{ $wallets_section['6'] }} @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
