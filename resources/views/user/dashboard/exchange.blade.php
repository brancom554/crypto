@extends('layouts.app')
@section('page-style')

  <link rel="stylesheet" href="{{ asset(mix('css/kyc/style.css'))}}">
@endsection
@section('content')
<!-- Exchange Dashboard  -->
    <div class="row match-height">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card card-congratulation-medal" style="max-height:22vh;">
                <div class="card-body">
                    <h5>Welcome 🎉 {{auth()->user()->firstname}}</h5>
                    <a href="{{route('user.exchange.market')}}" type="button" class="mt-3 btn btn-primary">Start Exchanging</a>
                    <img src="{{asset('images/illustration/badge.svg')}}" class="congratulation-medal"
                        alt="Medal Pic" />
                </div>
            </div>

            <div class="card card-transaction">
                <div class="card-header">
                    <h4 class="card-title">Wallets</h4>
                </div>
                <div class="card-body mb-1" style="max-height:46vh;overflow-y:auto;">
                    @forelse($wallets as $wallet)
                    <div class="transaction-item">
                        <div class="d-flex">
                            <div class="avatar bg-light-primary rounded float-start">
                                <img class="avatar-content"
                                    src="{{ getImage('assets/images/cryptoCurrency/'. strtolower($wallet->symbol).'.png') }}"
                                    alt="">
                            </div>
                            <div class="transaction-percentage">
                                <h6 class="transaction-title">
                                    <span class="text-danger">{{ $wallet->symbol }}</span>
                                </h6>
                                <small>{{getAmount($wallet->balance)}} {{$wallet->symbol}}</a></small>
                            </div>

                        </div>
                        <div class="fw-bolder">
                            @if ($wallet->symbol != 'USDT')
                            <a href="{{route('user.exchange.now', [$wallet->symbol, 'USDT'])}}"><button
                                    class="btn btn-sm btn-primary">Exchange</button></a>
                            @else
                                <a href="{{ route('user.deposit') }}" class="btn btn-success btn-sm">Deposit</a>
                            @endif
                        </div>
                    </div>
                    @empty
                        <div class="d-flex justify-content-between  align-items-center">
                            <span class="text-warning">{{ __('locale.Create your first wallet:')}}</span>
                            <form method="POST" action="{{ route('user.wallet.create') }}">
                                @csrf
                                <input type="hidden" id="id" name="id" value="USDT">
                                <button type="submit" class="btn btn-success btn-sm">Create Wallet</button></span>
                            </form>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card card-transaction">
                <div class="card-header">
                    <h4 class="card-title">Exchanges</h4>
                </div>
                <div class="card-body mb-1" style="max-height:70vh;overflow-y:auto;">
                    @forelse($exchanges as $exchange)
                    <div class="transaction-item">
                        <div class="d-flex">
                            <div class="avatar bg-light-primary rounded float-start">
                                @if($exchange->type == 1)
                                <img class="avatar-content"
                                    src="{{ getImage('assets/images/cryptoCurrency/'. strtolower($exchange->to).'.png') }}"
                                    alt="">
                                @elseif($exchange->type == 2)
                                <img class="avatar-content"
                                    src="{{ getImage('assets/images/cryptoCurrency/'. strtolower($exchange->from).'.png') }}"
                                    alt="">
                                @endif
                            </div>
                            <div class="transaction-percentage">
                                <h6 class="transaction-title">
                                    @if($exchange->type == 1)
                                    <span class="text-success">{{ __('locale.Buy')}}</span>
                                    @elseif($exchange->type == 2)
                                    <span class="text-danger">{{ __('locale.Sell')}}</span>
                                    @endif
                                </h6>
                                @if($exchange->type == 1)
                                <small>{{getAmount($exchange->amount_from)}} <a
                                        class="text-warning">{{$exchange->to}}</a></small>
                                @elseif($exchange->type == 2)
                                <small>{{getAmount($exchange->amount_from)}} <a
                                        class="text-warning">{{$exchange->from}}</a></small>
                                @endif
                            </div>

                        </div>
                        <div class="fw-bolder">
                            <span class="badge border-secondary">{{getAmount($exchange->price_was)}} <a
                                    class="text-warning">$</a></span>
                        </div>
                    </div>
                    @empty
                    <div colspan="100%"> {{ __('locale.No results found')}}!</div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- / Exchange card -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">
                @if($user_kyc == NULL)
                <div
                    class="card-body text-center d-flex justify-content-center align-items-center border-light rounded">
                    <div class="status-empty">
                        <div class="status-icon d-flex justify-content-center align-items-center">
                            <i class="bi bi-files"></i>
                        </div>
                        <span
                            class="status-text-d text-dark">{{__('You have not submitted your necessary documents to verify your identity.')}}{{ __(' In order to trade in our platform, please verify your identity.')}}</span>
                        <p class="">
                            {{__('It would great if you please submit the form. If you have any question, please feel free to contact our support team.')}}
                        </p>
                        <a href="{{ route('user.kyc.application') }}?state=new"
                            class="btn btn-primary">{{__('Click here to complete your KYC')}}</a>
                    </div>
                    @endif
                    {{-- IF SUBMITED @Thanks --}}
                    @if($user_kyc !== NULL && isset($_GET['thank_you']))
                    <div
                        class="card-body text-center d-flex justify-content-center align-items-center border-warning rounded">
                        <div class="status-thank">
                            <div class="status-icon d-flex justify-content-center align-items-center">
                                <i class="bi bi-check"></i>
                            </div>
                            <span
                                class="status-text-d large text-dark">{{__('You have completed the process of KYC')}}</span>
                            <p class="">
                                {{__('We are still waiting for your identity verification. Once our team verified your identity, you will be notified by email. You can also check your KYC  compliance status from your profile page.')}}
                            </p>
                        </div>
                        @endif

                        {{-- IF PENDING --}}
                        @if($user_kyc !== NULL && $user_kyc->status == 'pending' && !isset($_GET['thank_you']))
                        <div
                            class="card-body text-center d-flex justify-content-center align-items-center border-info rounded d-flex align-items-center">
                            <div class="status-process">
                                <div class="status-icon d-flex justify-content-center align-items-center">
                                    <i class="bi bi-infinity"></i>
                                </div>
                                <span class="text-dark">{{__('Your application verification under process.')}}</span>
                                <p class="">
                                    {{__('We are still working on your identity verification. Once our team verified your identity, you will be notified by email.')}}
                                </p>
                            </div>
                            @endif

                            {{-- IF REJECTED/MISSING --}}
                            @if($user_kyc !== NULL && ($user_kyc->status == 'missing' || $user_kyc->status ==
                            'rejected') &&
                            !isset($_GET['thank_you']))
                            <div
                                class="card-body text-center d-flex justify-content-center align-items-center border-warning rounded">
                                <div class="status{{ ($user_kyc->status == 'missing') ? '-warnning' : '-canceled' }}">
                                    <div class="status-icon d-flex justify-content-center align-items-center">
                                        <i class="bi bi-exclamation-lg"></i>
                                    </div>
                                    <span class="status-text-d text-dark">
                                        {{ $user_kyc->status == 'missing' ? __('We found some information to be missing.') : __('Sorry! Your application was rejected.') }}
                                    </span>
                                    <p class="">
                                        {{__('In our verification process, we found information that is incorrect or missing. Please resubmit the form. In case of any issues with the submission please contact our support team.')}}
                                    </p>
                                    <a href="{{ route('user.kyc.application') }}?state={{ $user_kyc->status == 'missing' ? 'missing' : 'resubmit' }}"
                                        class="btn btn-primary mt-0">{{__('Submit Again')}}</a>
                                </div>
                                @endif

                                {{-- IF VERIFIED --}}
                                @if($user_kyc !== NULL && $user_kyc->status == 'approved' && !isset($_GET['thank_you']))
                                <div
                                    class="card-body text-center d-flex justify-content-center align-items-center border-success rounded ">
                                    <div class="status-verified">
                                        <div class="status-icon d-flex justify-content-center align-items-center">
                                            <i class="bi bi-shield-check text-success"></i>
                                        </div>
                                        <span
                                            class="status-text-d text-dark">{{__('Your identity verified successfully.')}}</span>
                                        <p class="">
                                            {{__('One of our team members verified your identity. Now you can participate in our trading platform. Thank you.')}}
                                        </p>
                                        <a href="{{ route('user.exchange.market') }}"
                                            class="btn btn-primary">{{__('Start Exchanging')}}</a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="bi bi-gift text-warning font-large-2 mb-1"></i>
                                    <h5 class="card-title">Refer & Earn</h5>
                                    <p class="card-text">
                                        Refer your friends & Earn for 5% of every customer that complete 1 deposit in
                                        the platform.
                                    </p>
                                    <!-- modal trigger button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#referEarnModal">
                                        Invite
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- / refer and earn card -->
                        @include('user/partials/refer-earn')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        "use strict";
        function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            iziToast.success({message: "Referral Url Copied: " + copyText.value, position: "topRight"});
        }
    </script>
@endpush
