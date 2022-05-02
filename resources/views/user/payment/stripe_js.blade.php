@extends('layouts.app')
@section('content')

<div class="dashboard-section ">
    <div>
        <div class="pb-3">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="deposit-preview bg--body align-items-center">
                        <div class="deposit-thumb">
                            <img src="{{$deposit->gateway_currency()->methodImage()}}" alt="{{ __('locale.Payment Image')}}">
                        </div>
                        <div class="deposit-content justify-content-center">
                            <ul class="text-center pb-3">
                                <li>
                                    {{ __('locale.Final Amount')}}: <span class="text--success">{{getAmount($deposit->final_amo)}} {{__($deposit->method_currency)}}</span>
                                </li>
                                <li>
                                    {{ __('locale.To Get')}}: <span class="text--danger">{{getAmount($deposit->amount)}}  {{__($general->cur_text)}}</span>
                                </li>
                            </ul>
                           <form action="{{$data->url}}" method="{{$data->method}}">
                                <script
                                    src="{{$data->src}}"
                                    class="stripe-button"
                                    @foreach($data->val as $key=> $value)
                                    data-{{$key}}="{{$value}}"
                                    @endforeach
                                >
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            box-sizing: border--box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border--radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border--color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        .card button {
            padding-left: 0px !important;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";
        $(document).ready(function () {
            $('button[type="submit"]').addClass(" btn-success btn-round custom-success text-center btn-lg");
        })
    </script>
@endpush
