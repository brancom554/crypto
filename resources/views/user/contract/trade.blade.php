@extends('layouts.app')
@php
use \mobiledetect\mobiledetectlib\Detection;
$detect = new Mobile_Detect;
@endphp
@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.7/flipclock.min.css">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css'))}}">
    <style>
            .no-js #loader { display: none;  }
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            .se-pre-con {
                position: fixed;
                right: 0px;
                bottom: 0px;
                width: calc(100vw - (100vw - 100%) - 60px);
                height: calc(100vh - (100vh - 100%) - 62px);
                z-index: 9999;
                background: #161D31;
            }
            @media only screen and (max-width: 1200px) {
                .se-pre-con {
                    width: 100%;
                    height: calc(100vh - (100vh - 100%) - 62px);
                }
            }
            .se-pre-con2 {
                position: absolute;
                top: 50%;
                left: 50%;
            }
            .clock.flip-clock-wrapper ul {
            height: 48px;
            margin: 0 5px;
            width: 32px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.7);
            }

            .clock.flip-clock-wrapper ul li {
            line-height: 48px;
            }

            .clock.flip-clock-wrapper ul li a div div.inn {
            font-size: 40px;
            text-shadow: 0 1px 2px #000;
            }

            .clock.flip-clock-wrapper ul,
            .clock.flip-clock-wrapper ul li a div div.inn {
            border-radius: 8px;
            }

            .clock.flip-clock-wrapper ul li a div.down {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            }

            .clock.flip-clock-wrapper ul li a div.up:after {
            top: 23px;
            }

            .clock .flip-clock-dot.top {
            top: 12px;
            }

            .clock .flip-clock-dot.bottom {
            top: 28px;
            }

            .clock .flip-clock-dot {
            height: 8px;
            left: 8px;
            width: 8px;
            }

            .clock .flip-clock-divider {
            height: 48px;
            width: 24px;
            }
            .clock .flip-clock-divider:first-child {
            width: 0;
            }

            .clock .flip-clock-divider.seconds .flip-clock-label,
            .clock .flip-clock-divider.minutes .flip-clock-label {
            right: -84px;
            }

            .clock .flip-clock-divider .flip-clock-label {
            font-size: 10px;
            width: 84px;
            }
    </style>
    @if( $detect->isMobile() && !$detect->isTablet() )
        <style>
            .responsive-portrait {
            z-index         : 999999999999999;
            display         : none;
            position        : absolute;
            top             : 0;
            right           : 0;
            bottom          : 0;
            left            : 0;
            background      : #121828;
            align-items     : center;
            justify-content : center;
            height: 100vh;
            }

            .responsive-portrait > div {
            display        : flex;
            align-items    : center;
            flex-direction : column;
            }

            .responsive-portrait > div > img {
            width         : 300px;
            max-height: 300px;
            margin-bottom : 30px;
            fill          : #fff;
            }

            .responsive-portrait > div > span {
            color          : #fff;
            text-align     : center;
            text-transform : uppercase;
            text-shadow    : 1px 1px 5px rgba(0,0,0,0.5);
            font-size      : 14px;
            }
            body.nblr > * {
            filter : blur(2px);
            }

            body.nblr > .ov-nblr {
            filter : blur(0px);
            }
            @media
            only screen
            and (min-device-width               : 1px)
            and (max-device-width               : 897px)
            and (orientation                    : landscape) {
            .responsive-portrait {
                display : flex;
            }
            body > footer { display: none; }
            div.ads {
                display: none;
            }
            }
        </style>
    @endif
@endsection
@section('content')
<div class="se-pre-con">
    <div class="se-pre-con2 spinner-border text-primary" role="status">
        <span class="sr-only"></span>
    </div>
</div>

@if( $detect->isMobile() && !$detect->isTablet() )
<div class="responsive-portrait ov-nblr">
    <div>
        <div class="brand-text"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"
                alt="{{ __('locale.image')}}"></div>
        <span>Please turn your device in portrait mode.</span>
    </div>
</div>
<div class="row" style="margin-right:5px;">
    <div id="appM"></div>
</div>
<div class="position-absolute bottom-0 mb-1">
    <form id="playGame">
        <div class="card mb-1 mx-1">
            <div class="row justify-content-between align-items-center">
                <div class="col text-center">
                    <div type="button" class="btn fs-6 btn-sm btn-outline-secondary my-1">Amount</div>
                    <div class="input-group input-group-lg mb-1 w-100">
                        <input onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="Amount"
                            type="number" class="touchspin" required="" id="amount" name="amount">
                    </div>
                </div>
                <div class="col text-center">
                    <div class="btn-group highlight m-1" role="group">
                        <button id="Seconds" href="javascript:void(0)" type="button"
                            class="btn fs-6 btn-sm btn-outline-primary active">
                            Sec
                        </button>
                        <button id="Minutes" href="javascript:void(0)" type="button"
                            class="btn fs-6 btn-sm btn-outline-primary">
                            Min
                        </button>
                    </div>
                    <div class="input-group input-group-lg mb-1 w-100">
                        <input id="gametimesec" href="javascript:void(0)" type="number" class="touchspin" value="10">
                    </div>
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-center align-items-center mx-1">
            <button class="col-6 d-flex justify-content-between align-items-center w-50 btn btn-success highlowButton"
                type="submit" name="highlow" value="1">
                <div class="text-start">Rise</div>
                <div class="text-end"> {{ get_setting('profit') }}%</div>
            </button>
            <button
                class="col-6 d-flex justify-content-between align-items-center w-50 ms-1 btn btn-danger highlowButton"
                type="submit" name="highlow" value="2">
                <div class="text-start">Fall</div>
                <div class="text-end"> {{ get_setting('profit') }}%</div>
            </button>
        </div>
    </form>
</div>
@else
<div class="row" style="margin-right:5px;">
    <div id="app"></div>
    <div class="flex-end col-2 col-xll-2 col-xl-2 col-lg-2 col-md-3 col-sm-6">
        <div class="mt-5">
            <div class="card mb-1">
                {{-- <div class="btn-group dropstart"> --}}
                <button id="TType" type="button" class="btn btn-primary  mx-1 my-1">Rise / Fall</button>
                {{--  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" value="rf"
                        <div id="Tdrop" class="dropdown-menu">
                        <a class="dropdown-item" value="rf">Rise / Fall</a>
                        <a class="dropdown-item" value="oe">Odd / Even</a>
                    </div>
                </div> --}}
            </div>
            @if (Request::is('**/practice*','**/trade*'))
            <div class="card mb-1">
                <div class="btn-group highlight mx-1 my-1" role="group">
                    <button id="Seconds" href="javascript:void(0)" type="button"
                        class="btn fs-6 btn-sm btn-outline-primary active">
                        Sec
                    </button>
                    <button id="Minutes" href="javascript:void(0)" type="button"
                        class="btn fs-6 btn-sm btn-outline-primary">
                        Min
                    </button>
                </div>
                <div class="input-group input-group-lg mb-1 w-100">
                    <input id="gametimesec" href="javascript:void(0)" type="number" class="touchspin" value="10">
                </div>
            </div>
            <div class="card mb-1">
                <form id="playGame" class="mt-1 text-center">
                    <div class="predict-group">
                        <label for="amount" class="form-label">Amount in: {{ $general->cur_text }}</label>
                        <div class="input-group input-group-lg mb-1 w-100">
                            <input onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="Amount"
                                type="number" class="touchspin fs-6" required="" id="amount" name="amount">
                        </div>

                        <div class="highlow-predict mx-1">
                            <button
                                class="col d-flex justify-content-between align-items-center w-100 btn btn-success highlowButton"
                                type="submit" name="highlow" value="1">
                                <div class="text-start"><i class="bi bi-graph-up-arrow fs-3"
                                        style="margin-bottom:3px;"></i> Rise</div>
                                <div class="text-end"> {{ get_setting('profit') }}%</div>
                            </button>
                            <button
                                class="col d-flex justify-content-between align-items-center w-100  my-1 btn btn-danger highlowButton"
                                type="submit" name="highlow" value="2">
                                <div class="text-start"><i class="bi bi-graph-down-arrow fs-3"
                                        style="margin-bottom:3px;"></i> Fall</div>
                                <div class="text-end"> {{ get_setting('profit') }}%</div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @else
            <form method="POST" action="{{ route('user.exchange.store') }}" class="mt-1 text-center" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="hidden" id="symbol" name="from" value="{{ $from }}">
                    <input type="hidden" id="pair" name="to" value="{{ $to }}">
                    <label for="amount" class="form-label">Amount in: {{ $general->cur_text }}</label>
                    <div class="input-group input-group-lg mb-1 w-100">
                        <input onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" placeholder="Amount"
                            type="number" class="touchspin fs-6" required="" id="amount" name="amount">
                    </div>

                    <div class="mx-1">
                        <button
                            class="col d-flex justify-content-between align-items-center w-100 btn btn-success"
                            type="submit" value="1">
                            <div class="text-start"><i class="bi bi-graph-up-arrow fs-3"
                                    style="margin-bottom:3px;"></i> Buy</div>
                        </button>
                        <button
                            class="col d-flex justify-content-between align-items-center w-100  my-1 btn btn-danger"
                            type="submit">
                            <div class="text-start"><i class="bi bi-graph-down-arrow fs-3"
                                    style="margin-bottom:3px;"></i> Sell</div>
                        </button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endif

<div id="collapseContracts" class="collapse position-absolute sticky-top card-110">
    <div class="card" style="background:#131722e6!important;box-shadow: 0 4px 24px 0 rgb(0 0 0 / 30%);">
        @if (Request::is('**/practice**'))
            <livewire:contract.practice.box />
        @else
            <livewire:contract.trade.box />
        @endif
    </div>
</div>
<div class="modal fade" id="plotly" tabindex="-1" aria-labelledby="plotly" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-3 px-sm-3">
                <div class="nav-vertical vertical wizard-modern create-app-wizard">
                    <div class="row d-flex justify-content-center mb-1">
                        <div class="row mb-1">
                            <div class="col">
                                <h5 class="card-title">1 <span class="text-info">{{$currency->name}}</span>
                                    =
                                    <span class="text-warning" id="cryptoPrice"></span> <span>@lang("USD")
                                        </p>
                                </h5>
                            </div>
                            <div class="col">
                                <span class="trade-user-price"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="clock"></div>
                        </div>
                    </div>
                    <div id="graph" style="transform: scale(0.8);"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
    <div id="tradingview_02467" style="height:80vh;"></div>
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script type="text/javascript">
        new TradingView.widget({
            "autosize": true,
            "symbol": "COINBASE:{{$currency->symbol}}{{ $general->cur_text }}",
            "interval": "1",
            "timezone": "Etc/UTC",
            "theme": "dark",
            "style": "1",
            "locale": "en",
            "toolbar_bg": "#f1f3f6",
            "enable_publishing": false,
            "withdateranges": true,
            "hide_side_toolbar": false,
            "save_image": false,
            "container_id": "tradingview_02467"
        });
    </script>
</div>
<!-- TradingView Widget END --> --}}
@endsection
@section('page-script')
    @if( $detect->isMobile() && !$detect->isTablet() )
        <script src="{{ asset(mix('js/mainM.js')) }}"></script>
    @else
        <script src="{{ asset(mix('js/main.js')) }}"></script>
    @endif
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flipclock/0.7.7/flipclock.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/plotly.js/1.33.1/plotly-basic.min.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Dark.js"></script>
        <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js'))}}"></script>
    @endsection
@push('script')
    <script>
        /*$(function () {
            $("#Tdrop a").click(function () {
                $("#TType").text($(this).text());
                $("#TType").attr('value', $(this).attr('value'));
            });
        });*/
        "use strict";
        window.onload = prepareButton;
        let ws_i = new WebSocket('wss://stream.binance.com:9443/ws');
        async function prepareButton() {
            $(".se-pre-con").fadeOut("slow");
            var timesClicked = 0;
            if (ws_i.readyState == WebSocket.OPEN) {
                ws_i.send(JSON.stringify({
                    'method': 'UNSUBSCRIBE',
                    'params': ['{{strtolower($currency->symbol)}}usdt@depth10@100ms'],
                    'id': 1
                }))
                ws_i.send(JSON.stringify({
                    'method': 'UNSUBSCRIBE',
                    'params': ['{{strtolower($currency->symbol)}}usdt@depth20@100ms'],
                    'id': 2
                }))
                ws_i.send(JSON.stringify({
                    'method': 'UNSUBSCRIBE',
                    'params': ['{{strtolower($currency->symbol)}}usdt@ticker'],
                    'id': 3
                }))
                ws_i.send(JSON.stringify({
                    'method': 'UNSUBSCRIBE',
                    'params': ['{{strtolower($currency->symbol)}}usdt@miniTicker'],
                    'id': 4
                }))
            }
            document.getElementById('toggleInfo').onclick = function () {
                timesClicked++;
                if (timesClicked%2 == 0) {
                    ws_i.send(JSON.stringify({
                        'method': 'UNSUBSCRIBE',
                        'params': ['{{strtolower($currency->symbol)}}usdt@ticker'],
                        'id': 3
                    }))
                } else {
                    /* Binance */
                    let el_b = document.getElementById('show_b');
                    let last_b = null;
                    let el_P = document.getElementById('show_P');
                    let el_p = document.getElementById('show_p');
                    let slider = document.getElementById("myRange");
                    let sliderColor = document.getElementById("myRangeColor");
                    let el_l = document.getElementById('show_l');
                    let el_h = document.getElementById('show_h');
                    let min = document.getElementById("myRange").getAttribute('aria-valuemin');
                    let max = document.getElementById("myRange").getAttribute('aria-valuemax');
                    let now = document.getElementById("myRange").getAttribute('aria-valuenow');
                    let el_v = document.getElementById('show_v');
                    let el_mc = document.getElementById('show_mc');
                    let el_ts = document.getElementById('show_ts');
                    ws_i.send(JSON.stringify({
                        'method': 'SUBSCRIBE',
                        'params': ['{{strtolower($currency->symbol)}}usdt@ticker'],
                        'id': 3
                    }))
                    ws_i.onmessage = function (event1) {
                        let data = JSON.parse(event1.data);
                        let b = parseFloat(data.b).toFixed(2);
                        let P = parseFloat(data.P).toFixed(2);
                        let p = parseFloat(data.p).toFixed(2);
                        let o = parseFloat(data.o).toFixed(2);
                        let h = parseFloat(data.h).toFixed(2);
                        let l = parseFloat(data.l).toFixed(2);
                        let v = parseFloat(data.v).toFixed(2);
                        let q = parseFloat(data.q).toFixed(2);
                        let c = parseFloat(data.c).toFixed(2);
                        el_b.innerText = b;
                        if (b < last_b) {
                            el_b.innerHTML = b + '<i class="bi bi-arrow-down"></i>';
                            el_b.style.color = 'rgb(246,70,93';
                        } else if (b > last_b) {
                            el_b.innerHTML = b + '<i class="bi bi-arrow-up"></i>';
                            el_b.style.color = 'rgb(14,203,129)';
                        } else {
                            el_b.innerText = b;
                            el_b.style.color = 'dark';
                        }
                        last_b = b;
                        el_P.innerText = P;
                        el_p.innerText = p;
                        if (P < 0) {
                            el_P.innerHTML = '<i class="bi bi-arrow-down"></i>' + P + '%';
                            el_P.style.color = 'rgb(246,70,93';
                        } else if (P > 0) {
                            el_P.innerHTML = '<i class="bi bi-arrow-up"></i>' + P + '%';
                            el_P.style.color = 'rgb(14,203,129)';
                        } else {
                            el_P.innerHTML = '(' + P + ')';
                            el_P.style.color = 'dark';
                        }
                        el_p.innerText = p;

                        if (p < 0) {
                            el_p.innerText = p;
                            el_p.style.color = 'rgb(246,70,93';
                        } else if (p > 0) {
                            el_p.innerText = p;
                            el_p.style.color = 'rgb(14,203,129)';
                        } else {
                            el_p.innerText = p;
                            el_p.style.color = 'dark';
                        }
                        el_l.innerText = l;
                        el_h.innerText = h;
                        min = l;
                        max = h;
                        now = b;
                        let siz = 100 * ((now - min) / (max - min));
                        slider.style = 'width: ' + siz + '%';
                        if (siz > 66) {
                            sliderColor.classList.add('progress-bar-success')
                            sliderColor.classList.remove('progress-bar-warning')
                            sliderColor.classList.remove('progress-bar-danger')
                        } else if (siz > 33 && siz < 66) {
                            sliderColor.classList.add('progress-bar-warning')
                            sliderColor.classList.remove('progress-bar-success')
                            sliderColor.classList.remove('progress-bar-danger')
                        } else if (siz < 33) {
                            sliderColor.classList.add('progress-bar-danger')
                            sliderColor.classList.remove('progress-bar-success')
                            sliderColor.classList.remove('progress-bar-warning')
                        }
                        el_v.innerText = v;
                        let mc = ((q * c) / 100000000000).toFixed(2);
                        let ts = (q / 100000000).toFixed(2);
                        el_mc.innerText = mc + 'B';
                        el_ts.innerText = ts + 'M';
                    };
                }
            }
            document.getElementById('toggleDepth').onclick = function () {
                timesClicked++;
                if (timesClicked%2 == 0) {
                    ws_i.send(JSON.stringify({
                            'method': 'UNSUBSCRIBE',
                            'params': ['{{strtolower($currency->symbol)}}usdt@depth20@100ms'],
                            'id': 2
                        }))
                    } else {
                        ws_i.send(JSON.stringify({
                                'method': 'SUBSCRIBE',
                                'params': ['{{strtolower($currency->symbol)}}usdt@depth20@100ms'],
                                'id': 2
                            }))
                am5.ready(function () {
                    var root = am5.Root.new("chartdiv");
                    root.setThemes([
                        am5themes_Animated.new(root),
                        am5themes_Dark.new(root),
                    ]);
                    var chart = root.container.children.push(
                        am5xy.XYChart.new(root, {
                            focusable: true,
                            panX: false,
                            panY: false,
                            wheelX: "none",
                            wheelY: "none"
                        })
                    );

                    /*var title = chart.plotContainer.children.push(am5.Label.new(root, {
                        text: "Price (BTC/ETH)",
                        fontSize: 20,
                        fontWeight: "400",
                        x: am5.p50,
                        centerX: am5.p50
                    }))*/

                    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                        categoryField: "value",
                        renderer: am5xy.AxisRendererX.new(root, {
                            minGridDistance: 70
                        }),
                        tooltip: am5.Tooltip.new(root, {})
                    }));

                    xAxis.get("renderer").labels.template.adapters.add("text", function (text, target) {
                        if (target.dataItem) {
                            return root.numberFormatter.format(Number(target.dataItem.get("category")), "#.####");
                        }
                        return text;
                    });

                    var yAxis = chart.yAxes.push(
                        am5xy.ValueAxis.new(root, {
                            maxDeviation: 0.1,
                            renderer: am5xy.AxisRendererY.new(root, {})
                        })
                    );

                    var bidsTotalVolume = chart.series.push(am5xy.StepLineSeries.new(root, {
                        minBulletDistance: 10,
                        xAxis: xAxis,
                        yAxis: yAxis,
                        valueYField: "bidstotalvolume",
                        categoryXField: "value",
                        stroke: am5.color(0x00ff00),
                        fill: am5.color(0x00ff00),
                        tooltip: am5.Tooltip.new(root, {
                            pointerOrientation: "horizontal",
                            labelText: "[width: 120px]Ask:[/][bold]{categoryX}[/]\n[width: 120px]Total volume:[/][bold]{valueY}[/]\n[width: 120px]Volume:[/][bold]{bidsvolume}[/]"
                        })
                    }));
                    bidsTotalVolume.strokes.template.set("strokeWidth", 2)
                    bidsTotalVolume.fills.template.setAll({
                        visible: true,
                        fillOpacity: 0.2
                    });

                    var asksTotalVolume = chart.series.push(am5xy.StepLineSeries.new(root, {
                        minBulletDistance: 10,
                        xAxis: xAxis,
                        yAxis: yAxis,
                        valueYField: "askstotalvolume",
                        categoryXField: "value",
                        stroke: am5.color(0xf00f00),
                        fill: am5.color(0xff0000),
                        tooltip: am5.Tooltip.new(root, {
                            pointerOrientation: "horizontal",
                            labelText: "[width: 120px]Ask:[/][bold]{categoryX}[/]\n[width: 120px]Total volume:[/][bold]{valueY}[/]\n[width: 120px]Volume:[/][bold]{asksvolume}[/]"
                        })
                    }));
                    asksTotalVolume.strokes.template.set("strokeWidth", 2)
                    asksTotalVolume.fills.template.setAll({
                        visible: true,
                        fillOpacity: 0.2
                    });

                    var bidVolume = chart.series.push(am5xy.ColumnSeries.new(root, {
                        minBulletDistance: 10,
                        xAxis: xAxis,
                        yAxis: yAxis,
                        valueYField: "bidsvolume",
                        categoryXField: "value",
                        fill: am5.color(0x000000)
                    }));
                    bidVolume.columns.template.set("fillOpacity", 0.2);

                    var asksVolume = chart.series.push(am5xy.ColumnSeries.new(root, {
                        minBulletDistance: 10,
                        xAxis: xAxis,
                        yAxis: yAxis,
                        valueYField: "asksvolume",
                        categoryXField: "value",
                        fill: am5.color(0x000000)
                    }));
                    asksVolume.columns.template.set("fillOpacity", 0.2);

                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                        xAxis: xAxis
                    }));
                    cursor.lineY.set("visible", false);

                        function loadData() {
                            ws_i.onmessage = function (event2) {
                                var data = JSON.parse(event2.data);
                                var res = [];
                                processData(data.bids, "bids", true, res);
                                processData(data.asks, "asks", false, res);
                                xAxis.data.setAll(res);
                                bidsTotalVolume.data.setAll(res);
                                asksTotalVolume.data.setAll(res);
                                bidVolume.data.setAll(res);
                                asksVolume.data.setAll(res);
                            };
                        }

                        loadData();

                        function processData(list, type, desc, res) {

                            for (var i = 0; i < list.length; i++) {
                                list[i] = {
                                    value: Number(list[i][0]),
                                    volume: Number(list[i][1]),
                                }
                            }

                            list.sort(function (a, b) {
                                if (a.value > b.value) {
                                    return 1;
                                } else if (a.value < b.value) {
                                    return -1;
                                } else {
                                    return 0;
                                }
                            });

                            if (desc) {
                                for (var i = list.length - 1; i >= 0; i--) {
                                    if (i < (list.length - 1)) {
                                        list[i].totalvolume = list[i + 1].totalvolume + list[i].volume;
                                    } else {
                                        list[i].totalvolume = list[i].volume;
                                    }
                                    var dp = {};
                                    dp["value"] = list[i].value;
                                    dp[type + "volume"] = list[i].volume;
                                    dp[type + "totalvolume"] = list[i].totalvolume;
                                    res.unshift(dp);
                                }
                            } else {
                                for (var i = 0; i < list.length; i++) {
                                    if (i > 0) {
                                        list[i].totalvolume = list[i - 1].totalvolume + list[i].volume;
                                    } else {
                                        list[i].totalvolume = list[i].volume;
                                    }
                                    var dp = {};
                                    dp["value"] = list[i].value;
                                    dp[type + "volume"] = list[i].volume;
                                    dp[type + "totalvolume"] = list[i].totalvolume;
                                    res.push(dp);
                                }
                            }
                        }

                });
            }

            }
            document.getElementById('toggleOrders').onclick = function () {
                timesClicked++;
                if (timesClicked%2 == 0) {
                    ws_i.send(JSON.stringify({
                        'method': 'UNSUBSCRIBE',
                        'params': ['{{strtolower($currency->symbol)}}usdt@depth10@100ms'],
                        'id': 1
                    }))
                } else {
                    var computBarWidth = {
                        width: 250,
                        sortDepth: {
                            sort: function (e) {
                                return e.sort(function (e, t) {
                                    return e[1] - t[1]
                                }), e
                            },
                            median: function (e) {
                                var t = Math.floor(e.length / 3 * 2);
                                return e[t][1] < 1 ? 1 : e[t][1]
                            },
                            medianUnit: function (e, t, n) {
                                var r = new Array(e);
                                r = r[0];
                                var o = new Array(t);
                                o = o[0], r = r.concat(o);
                                var i = this.median(this.sort(r)) / n;
                                return o = r = null, i
                            },
                            width: function (e, t) {
                                if (0 == t) return 1;
                                var n = Math.round(Number(e) / t);
                                return n <= 0 ? 1 : 160 < n ? 160 : n
                            }
                        },
                        init: function (e, t) {
                            var n = [],
                                r = [];
                            e.forEach(function (e) {
                                n.push(e);
                            }), t.forEach(function (e) {
                                r.push(e)
                            });
                            var o = this.sortDepth.medianUnit(n, r, 48);
                            e.forEach(function (e) {
                                e.push({
                                    width: computBarWidth.sortDepth.width(e[1], o) * computBarWidth.width / 100
                                })
                            }), t.forEach(function (e) {
                                e.push({
                                    width: computBarWidth.sortDepth.width(e[1], o) * computBarWidth.width / 100
                                })
                            })
                        }
                    }

                    function number_format(number, decimals, decPoint, thousandsSep) {
                        number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
                        var n = !isFinite(+number) ? 0 : +number
                        var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
                        var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
                        var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
                        var s = ''

                        var toFixedFix = function (n, prec) {
                            var k = Math.pow(10, prec)
                            return '' + (Math.round(n * k) / k)
                                .toFixed(prec)
                        }

                        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
                        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
                        if (s[0].length > 3) {
                            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
                        }
                        if ((s[1] || '').length < prec) {
                            s[1] = s[1] || ''
                            s[1] += new Array(prec - s[1].length + 1).join('0')
                        }

                        return s.join(dec)
                    }
                    ws_i.send(JSON.stringify({
                        'method': 'SUBSCRIBE',
                        'params': ['{{strtolower($currency->symbol)}}usdt@depth10@100ms'],
                        'id': 1
                    }))
                    ws_i.onmessage = function (event3) {
                        let data = JSON.parse(event3.data);

                        computBarWidth.init(data.bids, data.asks);

                        $('.asks,.bids').empty();

                        $.each(data.asks, function (index, item) {
                            let row = $('<tr>')
                                .append($('<td>').css("color", "rgb(246,70,93)").addClass("price").append($("<span>").text(Number(item[0]).toFixed(2))))
                                .append($('<td>').addClass("quantity").append($("<span>").text(Number(item[1]).toFixed(6))))
                                .append($('<td>').addClass("btc").append($("<span>").text(number_format((item[0] * item[1]), 2, ",")))
                                    .append($("<div>").addClass("percent").css("width", item[2].width + "px")));

                            if (index > 10) row.hide();

                            $('.asks').prepend(row);
                        });
                        $.each(data.bids, function (index, item) {
                            let row = $('<tr>')
                                .append($('<td>').css("color", "rgb(14,203,129)").addClass("price").append($("<span>").text(Number(item[0]).toFixed(2))))
                                .append($('<td>').addClass("quantity").append($("<span>").text(Number(item[1]).toFixed(6))))
                                .append($('<td>').addClass("btc").append($("<span>").text(number_format((item[0] * item[1]), 2, ",")))
                                    .append($("<div>").addClass("percent").css("width", item[2].width + "px")));

                            if (index > 10) row.hide();

                            $('.bids').prepend(row);
                        });
                    }
                }
            }
        }

        $(document).ready(function () {
            var obj = [];
            var json = JSON.stringify(obj);
            var tradeLogId;
            var playTime;
            var playTimeUnit;
            var second;
            var highlowType;
            var coinId = "{{$currency->id}}";
            const highLowArray = [1, 2];
            @if (Request::is('**/practice*'))
            const userBalance = {{auth()->user()->practice_balance}};
            @else
            const userBalance = {{ auth()->user()->balance }};
            @endif
            playTime = document.getElementById("gametimesec").value;
            playTimeUnit = 'seconds';

            $(document).on('click', '#Seconds', function () {
                $(".highlight").children().removeClass('active');
                $(this).addClass('active');
                playTimeUnit = 'seconds';
            });
            $(document).on('click', '#Minutes', function () {
                $(".highlight").children().removeClass('active');
                $(this).addClass('active');
                playTimeUnit = 'minutes';
            });
            // Default Spin
            $('.touchspin').TouchSpin({
                buttondown_class: 'btn btn-primary',
                buttonup_class: 'btn btn-primary',
                buttondown_txt: feather.icons['minus'].toSvg(),
                buttonup_txt: feather.icons['plus'].toSvg()
            });

            // Icon Change
            $('.touchspin-icon').TouchSpin({
                buttondown_txt: feather.icons['chevron-down'].toSvg(),
                buttonup_txt: feather.icons['chevron-up'].toSvg()
            });
            $(document).on('keyup mouseup change', '#gametimesec', function () {
                playTime = document.getElementById("gametimesec").value;
            });

            $(".highlowButton").on('click', function () {
                highlowType = $(this).val();
            })

            $("#playGame").on('submit', function (event4) {
                event4.preventDefault();
                var amount = $('input[name="amount"]').val();
                var timeCount = secondCount();

                if (!highLowArray.includes(parseInt(highlowType))) {
                    notify('error', 'Invalid Game Type');
                } else if (userBalance < amount) {
                    @if (Request::is('**/practice*'))
                    notify('error', 'Your Practice Balance {{ getAmount(auth()->user()->practice_balance) }} {{$general->cur_text}} Not Enough! Please Add Practice Amount');
                    @else
                    notify('error', 'Your Practice Balance {{ getAmount(auth()->user()->balance) }} {{$general->cur_text}} Not Enough! Please Add Practice Amount');
                    @endif

                } else if (isNaN(amount) || amount <= 0) {
                    notify('error', 'Please Insert Valid Amount')
                } else if (isNaN(timeCount) || timeCount <= 0) {
                    notify('error', 'Please Select Valid Time')
                } else {
                    $('#plotly').modal('show');
                    var arrayLength = playTime + 2;
                    var newArray = [];
                    var xArray = [];
                    var timezone;
                    var gtime;
                    var coinSymbol = "{{$currency->symbol}}";

                    for (var i = 0; i < arrayLength; i++) {
                        var y;
                        var x;
                        newArray[i] = y
                        xArray[i] = x
                    }
                    var baseColor = "#{{ $general->base_color }}"
                    var trace1 = {
                        x: xArray,
                        y: newArray,
                        showlegend: true,
                        line: {
                            color: baseColor
                        },
                        visible: true,
                        xaxis: 'x1',
                        yaxis: 'y1',
                    };
                    var data = [trace1];
                    var layout = {
                        xaxis: {
                            tickfont: {
                                size: 14,
                                color: '#fff'
                            },
                            ticklen: 8,
                            tickwidth: 2,
                            tickcolor: '#8f2331'
                        },
                        yaxis: {
                            tickfont: {
                                size: 14,
                                color: '#fff'
                            },
                            ticklen: 8,
                            tickwidth: 2,
                            tickcolor: '#8f2331'
                        },
                        paper_bgcolor: '#141c24',
                        plot_bgcolor: '#141c24',
                        showlegend: false,
                    };
                    Plotly.newPlot('graph', {
                        data: data,
                        layout: layout
                    });
                    ws_i.send(JSON.stringify({
                            'method': 'SUBSCRIBE',
                            'params': ['{{strtolower($currency->symbol)}}usdt@miniTicker'],
                            'id': 4
                        }))
                    var inter = setInterval(function () {
                        var dateTime = new Date();
                        timezone = dateTime.getTimezoneOffset() / 60;
                        gtime = dateTime.getHours() + ':' + dateTime.getMinutes() + ':' + dateTime.getSeconds();
                        var time = dateTime.getHours() + ':' + dateTime.getMinutes() + ':' + dateTime.getSeconds();
                        ws_i.onmessage = function (eventX) {
                            let data = JSON.parse(eventX.data);
                            let o = parseFloat(data.c).toFixed(2);
                            let E = parseFloat(data.E);
                            $('#cryptoPrice').text(o);
                            var y = o;
                            var x = time;
                            newArray = newArray.concat(y)
                            newArray.splice(0, 1)
                            xArray = xArray.concat(x)
                            xArray.splice(0, 1)
                            obj.push({time: E, value:o});
                        };
                        var data_update = {
                            x: [xArray],
                            y: [newArray]
                        };

                        Plotly.update('graph', data_update)
                    }, 1000);
                    $('input[name="amount"]').val("");
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        @if (Request::is('**/practice*'))
                        url: "{{ route('user.practice.store') }}",
                        @else
                        url: "{{ route('user.trade.store') }}",
                        @endif
                        method: "POST",
                        data: {
                            amount: amount,
                            coinId: coinId,
                            highlowType: highlowType,
                            duration: playTime,
                            unit: playTimeUnit
                        },
                        success: function (response) {
                            if (response.value == 1) {
                                tradeLogId = response.tradeLogId;
                                countDown(timeCount, tradeLogId)

                                if (highlowType == 1) {

                                    $(".trade-user-price").text("You Trade: Rise. Price Was " + response.trade + " " + "USD");

                                    notify('success', 'Trade: Rise');
                                } else {

                                    $(".trade-user-price").text("You Trade: Fall. Price Was " + response.trade + " " + "USD");

                                    notify('success', 'Trade: Fall');
                                }

                            } else if (response.value == 2) {
                                notify('error', response.message);
                            } else {
                                $.each(response, function (i, val) {
                                    notify('error', val)
                                });
                            }
                        }
                    });
                }
            });

            function secondCount() {
                if (playTimeUnit == 'seconds') {
                    second = playTime;
                    return second;
                } else if (playTimeUnit == 'minutes') {
                    second = playTime * 60;
                    return second;
                }
            }

            function countDown(timeCount, tradeLogId) {
                var clock = $('.clock').FlipClock({
                    clockFace: 'MinuteCounter',
                    language: 'en',
                    autoStart: false,
                    countdown: true,
                    showSeconds: true,
                    callbacks: {
                        stop: function () {
                            gameResult(tradeLogId)
                        }
                    }
                });
                clock.setTime(timeCount - 1);
                clock.setCountdown(true);
                clock.start();
            }

            function gameResult(tradeLogId) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    @if (Request::is('**/practice*'))
                    url: "{{ route('user.practice.result') }}",
                    @else
                    url: "{{ route('user.trade.result') }}",
                    @endif
                    method: "POST",
                    data: {
                        tradeLogId: tradeLogId,
                        obj: obj
                    },
                    success: function (response) {
                        if (response == 1) {
                            notify('success', 'Trade Win');
                        } else if (response == 2) {
                            notify('error', 'Trade Lose');
                        } else if (response == 3) {
                            notify('error', 'Trade Draw');
                        } else {
                            $.each(response, function (i, val) {
                                notify('error', val)
                            });
                        }
                        setTimeout(function () {
                            /*ws_i.send(JSON.stringify({
                                'method': 'UNSUBSCRIBE',
                                'params': ['{{strtolower($currency->symbol)}}usdt@miniTicker'],
                                'id': 4
                            }))*/
                            //$('#plotly').modal('hide');
                            //Livewire.emit('plotlyRefresh')
                            location.reload();
                        }, 1000);
                    }
                });
            }
        });
    </script>
@endpush
