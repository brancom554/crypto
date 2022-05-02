@extends('layouts.app')
@section('content')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <h4 class="card-header">Site Settings</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="col ">
                                    <label class="form-control-label h6"> {{ __('locale.Site Title')}} </label>
                                    <input class="form-control form-control-lg" type="text" name="sitename"
                                        value="{{$general->sitename}}">
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <label class="form-control-label h6"> {{ __('locale.Site Base Color')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg form-control-color colorCode"
                                        name="base_color" value="{{ $general->base_color }}" />
                                    <input type='color' class="form-control form-control-lg form-control-color"
                                        style="max-width:25%;" value="{{$general->base_color}}" />
                                </div>
                            </div> --}}

                            <div class="col-md-3">
                                <div class="col ">
                                    <label class="form-control-label h6">{{ __('locale.Crypto Rate Api Key')}} </label>
                                    <input class="form-control form-control-lg" type="text" name="coin_api_key"
                                        value="{{$general->coin_api_key}}">
                                    <a href="https://coinmarketcap.com/"
                                        target="__blank"><small>https://coinmarketcap.com</small></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col ">
                                    <label class="form-control-label h6">{{ __('locale.Crypto Chart Api Key')}} </label>
                                    <input class="form-control form-control-lg" type="text" name="coin_rate_api"
                                        value="{{$general->coin_rate_api}}">
                                    <a href="https://min-api.cryptocompare.com"
                                        target="__blank"><small>https://min-api.cryptocompare.com</small></a>
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="col ">
                                    <label class="form-control-label h6">{{ __('locale.Default Dashboard For User')}} </label>
                                    <select class="form-select" aria-label="" id="dash_route" name="dash_route">
                                        <option value="practice" @if(get_setting('dash_route') == 'practice') selected @endif>Practice</option>
                                        <option value="trade" @if(get_setting('dash_route') == 'trade') selected @endif>Trade</option>
                                      </select>
                                      <small>If kyc approved link will redirect to {{ get_setting('dash_route') }} dashboard</small>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-title card-header">Extensions Settings</div>
                    <div class="card-body">

                    </div>
                </div> --}}
                <div class="card">
                    <h4 class="card-header">Rates Settings</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="col ">
                                    <label class="form-control-label h6">{{ __('locale.Currency')}}</label>
                                    <input class="form-control form-control-lg" type="text" name="cur_text"
                                        value="{{$general->cur_text}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="col ">
                                    <label class="form-control-label h6">{{ __('locale.Currency Symbol')}} </label>
                                    <input class="form-control form-control-lg" type="text" name="cur_sym"
                                        value="{{$general->cur_sym}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label h6">{{ __('locale.Practice Balance')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="practice_balance"
                                        placeholder="{{ __('locale.Enter Amount')}}"
                                        value="{{ getAmount($general->practice_balance) }}" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">{{ $general->practice_wallet }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col ">
                                    <label class="form-control-label h6">{{ __('locale.Practice Wallet')}} </label>
                                    <input class="form-control form-control-lg" type="text" name="practice_wallet"
                                        value="{{ $general->practice_wallet }}">
                                </div>
                            </div>
                            <div class="col-md-3 mt-1">
                                <label class="form-control-label h6">{{ __('locale.Trade Profit')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="profit"
                                        placeholder="{{ __('locale.Enter Amount')}}"
                                        value="{{getAmount($general->profit)}}" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                            <div class="col-md-3 mt-1">
                                <label class="form-control-label h6">{{ __('locale.Exchange Fee')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="exchange_fee"
                                        placeholder="{{ __('locale.Enter Percentage')}}"
                                        value="{{getAmount($general->exchange_fee)}}" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                            <div class="col-md-3 mt-1">
                                <label class="form-control-label h6">{{ __('locale.Referral Bonus')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="referral_bonus"
                                        placeholder="{{ __('locale.Enter Amount')}}"
                                        value="{{getAmount($general->referral_bonus) }}" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h4 class="card-header">Extra Settings</h4>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-start">

                            <div class="border-primary rounded p-1">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="me-1"
                                        for="referal_status">{{ __('locale.Referral Status')}}</label>
                                    <input class="form-check-input" type="checkbox" data-bs-toggle="toggle"
                                        data-onstyle="success" data-offstyle="danger" data-on="{{ __('locale.Active')}}"
                                        data-off="{{ __('locale.Inactive')}}" name="referal_status"
                                        @if($general->referal_status) checked @endif>
                                </div>
                            </div>

                            {{-- <div class="col col-md-4 mb-1 border border-primary rounded py-1">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="me-1"
                                        for="secure_password">{{ __('locale.Force Secure Password')}}</label>
                            <input class="form-check-input" type="checkbox" data-bs-toggle="toggle"
                                data-onstyle="success" data-offstyle="danger" data-on="{{ __('locale.Enable')}}"
                                data-off="{{ __('locale.Disabled')}}" name="secure_password"
                                @if($general->secure_password) checked @endif>
                        </div>
                    </div> --}}

                    <div class="border-primary rounded p-1 ms-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <label class="me-1"
                                for="secure_password">{{ __('locale.User Registration')}}</label>
                            <input class="form-check-input" type="checkbox" data-bs-toggle="toggle"
                                data-onstyle="success" data-offstyle="danger" data-on="{{ __('locale.Enable')}}"
                                data-off="{{ __('locale.Disabled')}}" name="registration" @if($general->registration)
                            checked @endif>
                        </div>
                    </div>
        <div class="border-primary rounded p-1 ms-1">
            <div class="d-flex align-items-center justify-content-between">
                <label class="me-1" for="secure_password">{{ __('locale.Force SSL')}}</label>
                <input class="form-check-input" type="checkbox" data-bs-toggle="toggle" data-onstyle="success"
                    data-offstyle="danger" data-on="{{ __('locale.Enable')}}" data-off="{{ __('locale.Disabled')}}"
                    name="force_ssl" @if($general->force_ssl)
                checked @endif>
            </div>
        </div>

        {{-- <div class="col col-md-4 mb-1 border border-primary rounded py-1">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="me-1"
                                        for="secure_password">{{ __('locale.Email Verification')}}</label>
        <input class="form-check-input" type="checkbox" data-bs-toggle="toggle" data-onstyle="success"
            data-offstyle="danger" data-on="{{ __('locale.Enable')}}" data-off="{{ __('locale.Disable')}}" name="ev"
            @if($general->ev) checked @endif>
    </div>
    </div>
    <div class="border-primary rounded p-1 ms-1">
        <div class="d-flex align-items-center justify-content-between">
            <label class="me-1" for="secure_password">{{ __('locale.Email Notification')}}</label>
            <input class="form-check-input" type="checkbox" data-bs-toggle="toggle" data-onstyle="success"
                data-offstyle="danger" data-on="{{ __('locale.Enable')}}" data-off="{{ __('locale.Disable')}}" name="en"
                @if($general->en) checked @endif>
        </div>
    </div> --}}
    {{-- @if($sms->status == 1)
    <div class="border-primary rounded p-1 ms-1">
        <div class="d-flex align-items-center justify-content-between">
            <label class="me-1" for="secure_password">{{ __('locale.SMS Verification')}}</label>
            <input class="form-check-input" type="checkbox" data-bs-toggle="toggle" data-onstyle="success"
                data-offstyle="danger" data-on="{{ __('locale.Enable')}}" data-off="{{ __('locale.Disable')}}" name="sv"
                @if($general->sv) checked @endif>
        </div>
    </div>
    <div class="border-primary rounded p-1 ms-1">
        <div class="d-flex align-items-center justify-content-between">
            <label class="me-1" for="secure_password">{{ __('locale.SMS Notification')}}</label>
            <input class="form-check-input" type="checkbox" data-bs-toggle="toggle" data-onstyle="success"
                data-offstyle="danger" data-on="{{ __('locale.Enable')}}" data-off="{{ __('locale.Disable')}}" name="sn"
                @if($general->sn) checked @endif>
        </div>
    </div>
    </div>
    @endif --}}
    </div>
    </div>
    <div class="card-footer text-end">
        <div class="col">
            <button type="submit" class="btn btn-primary">{{ __('locale.Update')}}</button>
        </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
@endsection

