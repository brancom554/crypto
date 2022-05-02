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
                                <script src="{{$data->checkout_js}}"
                                        @foreach($data->val as $key=>$value)
                                        data-{{$key}}="{{$value}}"
                                    @endforeach >
                                </script>
                                <input type="hidden" custom="{{$data->custom}}" name="hidden">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
    <script>
        "use strict";
        $(document).ready(function () {
            $('input[type="submit"]').addClass("btn btn-success");
        })
    </script>
@endpush
