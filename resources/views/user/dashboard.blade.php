@extends('layouts.app')
@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
  {{-- Page css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/kyc/style.css'))}}">
@endsection
@section('content')
<!-- Trade Wallet Dashboard  -->
<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body">
                    <h5>Welcome 🎉 {{auth()->user()->firstname}}</h5>
                    <p class="card-text font-small-3">You have earned</p>
                    <h3 class="mb-75 mt-2 pt-50">
                        <a href="#">$ {{ number_format($tradeWon, 2) }}</a>
                    </h3>
                    @if (Request::is('**/trade*'))
                    <a href="{{route('user.trade.market')}}" type="button" class="btn btn-primary">Start Trading</a>
                    @elseif (Request::is('**/practice*'))
                    <a href="{{route('user.practice.market')}}" type="button" class="btn btn-primary">Start Trading</a>
                    @endif
                    <img src="{{asset('images/illustration/badge.svg')}}" class="congratulation-medal"
                        alt="Medal Pic" />
                </div>
            </div>
        </div>
        <!--/ Medal Card -->
        <!-- Earnings Card -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card earnings-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title mb-2">Earnings</h4>
                            <div class="font-small-3">This Week</div>
                            <h5 class="mb-1">$ {{ to_num($perc['tradeWon_last_week'], 0, ',', false) }}</h5>
                            <p class="card-text text-muted font-small-3">
                                <span class="fw-bolder">{{ $perc['tradeWon_last_week_percentage'] }}%</span><span> Won since last week.</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div id="earnings-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Earnings Card -->
        <!-- CCard -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card">
                <div class="card-body"
                    style="background: url({{asset('images/slider/wallet.png')}});background-position: right;background-repeat: no-repeat;">
                    @if (Request::is('**/trade*'))
                    <p class="mb-1 fs-14 text-success">Balance</p>
                    <div class="d-flex justify-content-between">
                        <div class="h2 text-success mb-1">
                            {{$general->cur_sym}}
                            <livewire:partials.balance />
                        </div>
                        @else
                        <p class="mb-1 fs-14 text-warning">Balance</p>
                        <div class="d-flex justify-content-between">
                            <div class="h2 text-warning mb-1">
                                {{$general->cur_sym}}
                                <livewire:partials.practice-balance />
                            </div>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="">
                                <p class="font-small-2 me-1">VALID THRU</p>
                                <span>08/22</span>
                            </div>
                            <div class="">
                                <p class="font-small-2">CARD HOLDER</p>
                                <span class="card-text text-info font-small-3">{{auth()->user()->firstname}}
                                    {{auth()->user()->lastname}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--/ CCard -->
    </div>

    <div class="row match-height">
        <div class="col-lg-4 col-12">
            <div class="row">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar bg-light-info p-50 mb-1">
                                <div class="avatar-content">
                                    <i class="bi bi-bar-chart font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="fw-bolder">{{$tradeLog}}</h2>
                            <p class="card-text">Total Trade Log</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar bg-light-success p-50 mb-1">
                                <div class="avatar-content">
                                    <i class="bi bi-graph-up-arrow font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="fw-bolder">{{$tradeWin}}</h2>
                            <p class="card-text">Total Wining Trade</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar bg-light-warning p-50 mb-1">
                                <div class="avatar-content">
                                    <i class="bi bi-slash-lg font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="fw-bolder">{{$tradeDraw}}</h2>
                            <p class="card-text">Total Draw Trade</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar bg-light-danger p-50 mb-1">
                                <div class="avatar-content">
                                    <i class="bi bi-graph-down-arrow font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="fw-bolder">{{$tradeLose}}</h2>
                            <p class="card-text">Total Losing Trade</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Report Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card card-transaction">
                <div class="card-header">
                    <h4 class="card-title">Contracts</h4>
                    {{-- <div class="dropdown chart-dropdown">
                        <i class="bi bi-three-dots-vertical font-medium-3 cursor-pointer"
                            data-bs-toggle="dropdown"></i>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Last 28 Days</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                            <a class="dropdown-item" href="#">Last Year</a>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body" style="max-height:280px;overflow-y:auto;">
                    @forelse($tradelogs as $tradelog)
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-primary rounded float-start">
                                    @if (Request::is('**/trade*'))
                                    <a href="{{ route('user.trade.contract.log.preview', $tradelog->id) }}">
                                    @else
                                    <a href="{{ route('user.practice.contract.log.preview', $tradelog->id) }}">
                                    @endif
                                    <div class="avatar-content">
                                        @if($tradelog->hilow == 1)
                                        <span class="text-success font-medium-5"><i class="bi bi-graph-up-arrow"></i></span>
                                        @elseif($tradelog->hilow == 2)
                                        <span class="text-danger font-medium-5"><i
                                                class="bi bi-graph-down-arrow"></i></span>
                                        @endif
                                    </div></a>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">
                                        @if($tradelog->hilow == 1)
                                        <span class="text-success">{{ __('locale.Rise')}}</span>
                                        @elseif($tradelog->hilow == 2)
                                        <span class="text-danger">{{ __('locale.Fall')}}</span>
                                        @endif
                                    </h6>
                                    <small>{{__($tradelog->crypto->name)}} / {{ $general->cur_text }}</small>
                                </div>

                            </div>
                            <div class="fw-bolder">
                                @if($tradelog->result == 1)
                                <span class="badge bg-success">+ {{getAmount($tradelog->amount)}}
                                    {{$general->cur_text}}</span>
                                @elseif($tradelog->result == 2)
                                <span class="badge bg-danger">- {{getAmount($tradelog->amount)}}
                                    {{$general->cur_text}}</span>
                                @elseif($tradelog->result == 3)
                                <span class="badge bg-warning">{{ __('locale.Draw')}}</span>
                                @else
                                <span class="badge bg-warning">{{ __('locale.Pending')}}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                    <div colspan="100%"> {{ __('locale.No results found')}}!</div>
                    @endforelse
                </div>
            </div>
        </div>

        @if (Request::is('**/practice*'))
        <!-- Exchange card -->
        {{-- <div class="col-lg-4 col-md-6">
            <div class="card">
                <h4 class="card-header">Wallet Exchange</h4>
                <div class="card-body">
                        <livewire:wallet.practice-wallet-exchange />
                </div>
            </div>
        </div> --}}
        <!-- / Exchange card -->

        {{-- <div class="col-lg-4 col-md-6">
            <div class="card">
                <img class="card-img img-fluid img-responsive" style="background-" src="{{asset('images/slider/market.png')}}"
                    alt="market" />
                <div class="card-img-overlay bg-overlay">
                    <div class="card-body">
                        <div class="text-center rounded p-1 my-auto" style="background: #0000009c;">
                            <p class="card-text">
                                <p>View the latest trending coins in the market with live 24h updates</p>
                                <div class="btn btn-outline-light">Visit The Market</div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        <!-- KYC card -->

            <div class="col-lg-4 col-md-6">
                @include('user/partials/kyc')
            </div>
        @endif
        <!-- / KYC card -->
        <!-- refer and earn card -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body text-center mt-3">
                    <i class="bi bi-gift text-warning font-large-2 mb-1"></i>
                    <h5 class="card-title">Refer & Earn</h5>
                    <p class="card-text">
                        Refer your friends & Earn for 5% of every customer that complete 1 deposit in the platform.
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
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
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

        var $tradePositive = {{ $tradeWin }} - {{ $tradeLose }};
        var $totaltrades = {{ $tradeWin }} + {{ $tradeLose }} + {{ $tradeDraw }} ;
        var $tradePositive = (typeof $tradePositive === 'undefined') ? '0' : $tradePositive;
        $(window).on('load', async function () {
        'use strict';

        var $barColor = '#f3f3f3';
        var $trackBgColor = '#EBEBEB';
        var $textMutedColor = '#b9b9c3';
        var $budgetStrokeColor2 = '#dcdae3';
        var $goalStrokeColor2 = '#51e5a8';
        var $strokeColor = '#ebe9f1';
        var $textHeadingColor = '#5e5873';
        var $earningsStrokeColor2 = '#28c76f66';
        var $earningsStrokeColor3 = '#28c76f33';

        var $statisticsOrderChart = document.querySelector('#statistics-order-chart');
        var $statisticsProfitChart = document.querySelector('#statistics-profit-chart');
        var $earningsChart = document.querySelector('#earnings-chart');
        var $revenueReportChart = document.querySelector('#revenue-report-chart');
        var $budgetChart = document.querySelector('#budget-chart');
        var $browserStateChartPrimary = document.querySelector('#browser-state-chart-primary');
        var $browserStateChartWarning = document.querySelector('#browser-state-chart-warning');
        var $browserStateChartSecondary = document.querySelector('#browser-state-chart-secondary');
        var $browserStateChartInfo = document.querySelector('#browser-state-chart-info');
        var $browserStateChartDanger = document.querySelector('#browser-state-chart-danger');
        var $goalOverviewChart = document.querySelector('#goal-overview-radial-bar-chart');

        var statisticsOrderChartOptions;
        var statisticsProfitChartOptions;
        var earningsChartOptions;
        var revenueReportChartOptions;
        var budgetChartOptions;
        var browserStatePrimaryChartOptions;
        var browserStateWarningChartOptions;
        var browserStateSecondaryChartOptions;
        var browserStateInfoChartOptions;
        var browserStateDangerChartOptions;
        var goalOverviewChartOptions;

        var statisticsOrderChart;
        var statisticsProfitChart;
        var earningsChart;
        var revenueReportChart;
        var budgetChart;
        var browserStatePrimaryChart;
        var browserStateDangerChart;
        var browserStateInfoChart;
        var browserStateSecondaryChart;
        var browserStateWarningChart;
        var goalOverviewChart;
        var isRtl = $('html').attr('data-textdirection') === 'rtl';

        //--------------- Earnings Chart ---------------
        //----------------------------------------------
        earningsChartOptions = {
            chart: {
            type: 'donut',
            height: 120,
            toolbar: {
                show: false
            }
            },
            dataLabels: {
            enabled: false
            },
            series: [{{ $tradeWin }}, {{ $tradeDraw }}, {{ $tradeLose }}],
            legend: { show: false },
            comparedResult: [2, -3, 8],
            labels: ['Wins', 'Draws', 'Loses'],
            stroke: { width: 0 },
            colors: [window.colors.solid.success, $earningsStrokeColor3, '#EA5455'],
            grid: {
            padding: {
                right: -20,
                bottom: -8,
                left: -20
            }
            },
            plotOptions: {
            pie: {
                startAngle: -10,
                donut: {
                labels: {
                    show: true,
                    name: {
                    offsetY: 15
                    },
                    value: {
                    offsetY: -15,
                    formatter: function (val) {
                        return parseFloat((val / $totaltrades) * 100).toFixed(1) + '%';
                    }
                    },
                    total: {
                    show: true,
                    offsetY: 15,
                    label: 'Positive',
                    formatter: function (w) {
                        return $tradePositive;
                    }
                    }
                }
                }
            }
            },
            responsive: [
            {
                breakpoint: 1325,
                options: {
                chart: {
                    height: 100
                }
                }
            },
            {
                breakpoint: 1200,
                options: {
                chart: {
                    height: 120
                }
                }
            },
            {
                breakpoint: 1045,
                options: {
                chart: {
                    height: 100
                }
                }
            },
            {
                breakpoint: 992,
                options: {
                chart: {
                    height: 120
                }
                }
            }
            ]
        };
        earningsChart = new ApexCharts($earningsChart, earningsChartOptions);
        earningsChart.render();
});
    </script>
@endpush
