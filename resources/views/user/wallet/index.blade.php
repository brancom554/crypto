@extends('layouts.app')
@section('content')
<div class="row match-height">
    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <livewire:wallet.index/>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">{{ __('locale.Deposit Method')}}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gatewayCurrency as $data)
                        <tr class="">
                            <td data-label="{{ __('locale.Deposit Method')}}">
                                <div class="row centerize">
                                    <div class="col-md-3 thumb">
                                        <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $data->image,imagePath()['gateway']['size'])}}"
                                            alt="{{ __('locale.image')}}"></div>
                                    <span class="col-md-9 name">{{__($data->name)}}</span>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:void(0)" data-id="{{$data->id}}" data-resource="{{$data}}"
                                    data-min_amount="{{getAmount($data->min_amount)}}"
                                    data-max_amount="{{getAmount($data->max_amount)}}"
                                    data-base_symbol="{{$data->baseSymbol()}}"
                                    data-fix_charge="{{getAmount($data->fixed_charge)}}"
                                    data-percent_charge="{{getAmount($data->percent_charge)}}" class="btn btn-success btn-sm  deposit" data-bs-toggle="modal" data-bs-target="#deposit-modal">
                                        {{ __('locale.Deposit Now')}}</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-end" colspan="100%">{{ __($empty_message) }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table><!-- table end -->
            </div>
        </div><!-- card end -->
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">{{ __('locale.Withdraw Method')}}</th>
                            <th scope="col">{{ __('locale.Info')}}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gatewayCurrency as $data)
                        <tr>
                            <td data-label="{{ __('locale.Withdraw Method')}}">
                                <div class="row centerize">
                                    <div class="col-md-3 thumb">
                                        <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $data->image,imagePath()['gateway']['size'])}}"
                                            alt="{{ __('locale.image')}}"></div>
                                    <span class="col-md-9 name">{{__($data->name)}}</span>
                                </div>
                            </td>
                            <td>
                                <li>@lang('Limit')
                                    : {{getAmount($data->min_limit)}}
                                    - {{getAmount($data->max_limit)}} {{__($general->cur_text)}}</li>

                                <li> {{ __('locale.Charge')}}
                                    - {{getAmount($data->fixed_charge)}} {{__($general->cur_text)}}
                                    + {{getAmount($data->percent_charge)}}%
                                </li>
                                <li>@lang('Processing Time')
                                    - {{$data->delay}}
                                </li>
                            </td>

                            <td>
                                <a href="javascript:void(0)"  data-id="{{$data->id}}"
                                    data-resource="{{$data}}"
                                    data-min_amount="{{getAmount($data->min_limit)}}"
                                    data-max_amount="{{getAmount($data->max_limit)}}"
                                    data-fix_charge="{{getAmount($data->fixed_charge)}}"
                                    data-percent_charge="{{getAmount($data->percent_charge)}}"
                                    data-base_symbol="{{__($general->cur_text)}}"
                                    class="btn btn-warning btn-sm deposit" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                     @lang('Withdraw Now')</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table><!-- table end -->
            </div>
        </div><!-- card end -->
    </div>
</div>
@endsection
