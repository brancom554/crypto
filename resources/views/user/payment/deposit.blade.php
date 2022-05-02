@extends('layouts.app')
@section('content')

<div class="dashboard-section ">
    <div>
        <div class="pb-3">
            <div class="row g-4">
                @foreach($gatewayCurrency as $data)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="card custom--card deposit--card">
                            <div class="card-header">
                                <h5 class="card-title">{{__($data->name)}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="deposit__thumb">
                                    <img class="img-thumbnail" src="{{$data->methodImage()}}" alt="{{__($data->name)}}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0)" data-id="{{$data->id}}" data-resource="{{$data}}"
                               data-min_amount="{{getAmount($data->min_amount)}}"
                               data-max_amount="{{getAmount($data->max_amount)}}"
                               data-base_symbol="{{$data->baseSymbol()}}"
                               data-fix_charge="{{getAmount($data->fixed_charge)}}"
                               data-percent_charge="{{getAmount($data->percent_charge)}}" class="btn-sm d-block btn btn-primary text-center deposit" data-bs-toggle="modal" data-bs-target="#deposit-modal">
                                {{ __('locale.Deposit Now')}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

    <!-- Deposit Modal -->
    <div class="modal fade custom--modal" id="deposit-modal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title method-name"></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <form class="deposite-form" action="{{route('user.deposit.insert')}}" method="POST">
                    @csrf
                    <input type="hidden" name="currency" class="edit-currency" value="">
                    <input type="hidden" name="method_code" class="edit-method-code" value="">
                    <div class="modal-body">
                        <ul class="mb-4">
                            <li>
                                <span>{{ __('locale.Deposit Limit')}}</span> <span class="text--success depositLimit"></span>
                            </li>
                            <li>
                                <span>{{ __('locale.Charge')}}</span> <span class="text--danger depositCharge"></span>
                            </li>
                        </ul>
                        <label for="amount" class="label">{{ __('locale.Enter Amount')}}</label>
                        <div class="input-group mb-3">
                            <input id="amount" type="text" class="form-control cmn--form--control" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00" required=""  value="{{old('amount')}}">
                            <span class="input-group-text bg--info px-3 cmn--form--control">{{$general->cur_text}}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm text--white btn-danger" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                        <button type="submit" class="btn btn-primary btn-sm text--white btn-success">{{ __('locale.Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        "use strict";
        $(document).ready(function(){
            $('.deposit').on('click', function () {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "{{__($general->cur_text)}}";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge = `${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`{{ __('locale.Payment By ')}} ${result.name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.method_code);
            });
        });
    </script>
@endpush
