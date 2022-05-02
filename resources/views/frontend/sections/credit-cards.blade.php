<!-- Credit Cards Management -->
<x-utils.container>
    <div class="row gap-y align-items-center">
        <div class="col-md-6">
            <div class="card shadow bg-dark no-action mx-auto wallet">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <img src="{{ asset("img/avatar/1.jpg") }}" class="icon-md rounded-circle" alt="">
                    <span class="text-uppercase small bold">checkout</span>
                    <i data-feather="bell"></i>
                </div>

                <div class="card-body">
                    @php($cards = [
                        [ "style" => "1" ],
                        [ "style" => "2" ],
                        [ "style" => "3" ]
                    ])
                    <div class="swiper-container" data-sw-autoplay="2500">
                        <div class="swiper-wrapper">
                            @foreach ($cards as $card)
                                <div class="swiper-slide">
                                    <div class="card credit-card credit-card-st{{ $card['style'] }}">
                                        <div class="shapes-container">
                                            <div class="shape shape-1"><div></div></div>
                                            <div class="shape shape-2"><div></div></div>
                                        </div>

                                        <div class="card-body">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col d-flex">
                                                    <div class="icon-md rounded-circle bg-danger op-7"></div>
                                                    <div class="icon-md rounded-circle bg-warning op-7" style="transform: translateX(-50%)"></div>
                                                </div>
                                                <div class="col-auto">
                                                    <span class="badge badge-success">Active</span>
                                                </div>
                                            </div>
                                            <div class="my-4">
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <div class="d-flex">
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                        <div class="safe-digit"></div>
                                                    </div>
                                                    <div class="text-dark bold">1234</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="small text-muted">Card holder</div>
                                                    <div class="text-dark semi-bold h6">John Doe</div>
                                                </div>
                                                <div class="col text-end">
                                                    <div class="small text-muted">Expires</div>
                                                    <div class="text-dark semi-bold h6">08/24</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card card-details bg-contrast" data-aos="fade-up">
                    <div class="card-body pb-0 d-flex align-items-center justify-content-between">
                        <h6 class="m-0 bold">Summary</h6>
                        <button class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i></button>
                    </div>

                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @php ($transactions = [
                                [ "name" => 'Bitcoin', "description" => "Rise trade 3 hours duration", "amount" => "535.45" ],
                                [ "name" => 'Litecoin', "description" => "Fall trade 1 hours duration", "amount" => "183.95" ],
                                [ "name" => 'Dogecoin', "description" => "Rise trade 20 min duration", "amount" => "5.99" ]
                            ])
                            @foreach ($transactions as $transaction)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between mb-0">
                                        <div class="text-start">
                                            <p class="my-0 semi-bold font-sm">{{ $transaction['name'] }}</p>
                                            @if ( isset($transaction['description']) )
                                            <p class="my-0 small text-muted">{{ $transaction['description'] }}</p>
                                            @endif
                                        </div>

                                        <div class="text-end">
                                            <p class="my-0 bold font-sm">${{ $transaction['amount'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="list-group-item px-0 pb-0">
                                <div class="d-flex justify-content-between mb-0">
                                    <div class="text-start">Total</div>
                                    <div class="text-end"><span class="bold">$ 725.39</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block btn-place-order">
                        Trade
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="section-heading" data-aos="fade-up">
                <h2 class="heading-line bold"><span class="light">{{ $card_section['0'] }}</span> <br>{{ $card_section['1'] }}</h2>
                <p class="lead">{{ $card_section['2'] }}</p>
            </div>

            <p class="mb-5">{{ $card_section['3'] }}</p>

            <a href="/login" class="btn btn-rounded btn-outline-darker">{{ $card_section['4'] }}</a>
        </div>
    </div>
</x-utils.container>
