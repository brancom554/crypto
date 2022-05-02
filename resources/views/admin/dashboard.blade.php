@extends('layouts.app')
@section('content')
    <div class="row mb-none-30">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{$widget['total_users']}} <a href="{{route('admin.users.all')}}" class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Users')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-people font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-1"></div>
            </div>
          </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{$widget['verified_users']}} <a href="{{route('admin.users.active')}}" class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Verified Users')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-people-fill font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-2"></div>
            </div>
          </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{$widget['email_unverified_users']}} <a href="{{route('admin.users.emailUnverified')}}" class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Email Unverified Users')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-envelope font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-3"></div>
            </div>
          </div>

        {{-- <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{$widget['sms_unverified_users']}} <a href="{{route('admin.users.smsUnverified')}}" class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.SMS Unverified Users')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-chat-left-dots font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-4"></div>
            </div>
          </div> --}}

          {{-- <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{ $kyc['totalkyc'] }} <a href="kyc_list" class="btn btn-sm text-small bg-white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.KYC Applications')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-chat-left-dots font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-13"></div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{ $kyc['pendingkyc'] }} <a href="kyc_list/pending" class="btn btn-sm text-small bg-white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Pending KYC')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-chat-left-dots font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-14"></div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{ $kyc['missingkyc'] }} <a href="kyc_list/missing" class="btn btn-sm text-small bg-white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Missing KYC')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-chat-left-dots font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-15"></div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{ $kyc['approvedkyc'] }} <a href="kyc_list/approved" class="btn btn-sm text-small bg-white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Approved KYC')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-chat-left-dots font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-16"></div>
            </div>
          </div> --}}

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{$cryptoCurrency}} <a href="{{route('admin.crypto.index')}}" class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Crypto Currency')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-wallet2 font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-5"></div>
            </div>
          </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{$tradeLog['log']}} <a href="{{route('admin.trade.log.list')}}" class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Trade Log')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-currency-exchange font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-6"></div>
            </div>
          </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{$tradeLog['wining']}} <a href="{{route('admin.trade.log.wining')}}" class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Wining Trade')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-journal-arrow-up font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-7"></div>
            </div>
          </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header align-items-start pb-0">
                <div>
                  <h2 class="fw-bolder">{{$tradeLog['losing']}} <a href="{{route('admin.trade.log.losing')}}" class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a></h2>
                  <p class="card-text">{{ __('locale.Losing Trade')}}</p>
                </div>
                <div class="avatar bg-light-success p-50">
                  <div class="avatar-content">
                    <i class="bi bi-journal-arrow-down font-medium-5"></i>
                  </div>
                </div>
              </div>
              <div id="line-area-chart-8"></div>
            </div>
          </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('locale.Monthly  Deposit & Withdraw  Report')}}</h5>
                    <div id="apex-bar-chart"> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="row">
                <div class="col">
                    <div class="card text-center">
                      <div class="card-body">
                        <div class="avatar bg-light-info p-50 mb-1">
                          <div class="avatar-content">
                            <i class="bi bi-wallet2 font-medium-5"></i>
                          </div>
                        </div>
                        <h2 class="fw-bolder">{{$payment['total_deposit']}}</h2>
                        <p class="card-text">{{ __('locale.Deposit')}}</p>
                      </div>
                    </div>
                  </div>

                <div class="col">
                    <div class="card text-center">
                      <div class="card-body">
                        <div class="avatar bg-light-warning p-50 mb-1">
                          <div class="avatar-content">
                            <i class="bi bi-cash font-medium-5"></i>
                          </div>
                        </div>
                        <h2 class="fw-bolder">{{getAmount($payment['total_deposit_amount'])}} {{__($general->cur_text)}}</h2>
                        <p class="card-text">{{ __('locale.Deposited Amount')}}</p>
                      </div>
                    </div>
                  </div></div>
                  <div class="row">
                <div class="col">
                    <div class="card text-center">
                      <div class="card-body">
                        <div class="avatar bg-light-danger p-50 mb-1">
                          <div class="avatar-content">
                            <i class="bi bi-cash-coin font-medium-5"></i>
                          </div>
                        </div>
                        <h2 class="fw-bolder">{{getAmount($payment['total_deposit_charge'])}} {{__($general->cur_text)}}</h2>
                        <p class="card-text">{{ __('locale.Deposit Charge')}}</p>
                      </div>
                    </div>
                  </div>

                <div class="col">
                    <div class="card text-center">
                      <div class="card-body">
                        <div class="avatar bg-light-primary p-50 mb-1">
                          <div class="avatar-content">
                            <i class="bi bi-cash-stack font-medium-5"></i>
                          </div>
                        </div>
                        <h2 class="fw-bolder">{{$payment['total_deposit_pending']}}</h2>
                        <p class="card-text">{{ __('locale.Pending Deposit')}}</p>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>


    <div class="row mt-50 mb-none-30">

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start pb-0">
                    <div>
                        <h2 class="fw-bolder mt-1">{{ $paymentWithdraw['total_withdraw'] }} <a
                                href="{{ route('admin.withdraw.method.index') }}"
                                class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a>
                        </h2>
                        <p class="card-text">{{ __('locale.Withdraw')}}</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="bi bi-wallet font-medium-5"></i>
                        </div>
                    </div>
                </div>
                <div id="line-area-chart-9"></div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start pb-0">
                    <div>
                        <h2 class="fw-bolder mt-1">
                            {{ getAmount($paymentWithdraw['total_withdraw_amount']) }}
                            {{ __($general->cur_text) }}
                        </h2>
                        <p class="card-text">{{ __('locale.Withdraw')}}</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="bi bi-coin font-medium-5"></i>
                        </div>
                    </div>
                </div>
                <div id="line-area-chart-10"></div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start pb-0">
                    <div>
                        <h2 class="fw-bolder mt-1">{{getAmount($paymentWithdraw['total_withdraw_charge'])}} {{__($general->cur_text)}}
                        </h2>
                        <p class="card-text">{{ __('locale.Withdraw Charge')}}</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="bi bi-cash-coin font-medium-5"></i>
                        </div>
                    </div>
                </div>
                <div id="line-area-chart-11"></div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start pb-0">
                    <div>
                        <h2 class="fw-bolder mt-1">{{$paymentWithdraw['total_withdraw_pending']}} <a
                                href="{{route('admin.withdraw.pending')}}"
                                class="btn btn-sm text-small bg--white text-red">{{ __('locale.View All')}}</a>
                        </h2>
                        <p class="card-text">{{ __('locale.Withdraw Pending')}}</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="bi bi-clock-history font-medium-5"></i>
                        </div>
                    </div>
                </div>
                <div id="line-area-chart-12"></div>
            </div>
        </div>
    </div>


    <div class="row mb-none-30 mt-5">

        <div class="col-xl-7">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('locale.New User list')}}</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('locale.User')}}</th>
                                        <th>{{ __('locale.Username')}}</th>
                                        <th>{{ __('locale.Email')}}</th>
                                        <th>{{ __('locale.Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestUser as $user)
                                    <tr>
                                        <td data-label="{{ __('locale.User')}}">
                                            <div class="row centerize">
                                                <div class="col-md-3 thumb">
                                                    <img src="{{ $user->profile_photo_url ? $user->profile_photo_url : asset('images/portrait/small/avatar-s-11.jpg') }}"
                                            alt="{{ __('locale.image')}}">
                                        </div>
                                                <span class="col-md-9 name">{{$user->fullname}}</span>
                                            </div>
                                        </td>
                                        <td data-label="{{ __('locale.Username')}}"><a
                                                href="{{ route('admin.users.detail', $user->id) }}">{{ $user->username }}</a>
                                        </td>
                                        <td data-label="{{ __('locale.Email')}}">{{ $user->email }}</td>
                                        <td data-label="{{ __('locale.Action')}}">
                                            <a href="{{ route('admin.users.detail', $user->id) }}">
                                                <button class="btn btn-icon btn-warning btn-sm"
                                                data-bs-toggle="tooltip" data-original-title="{{ __('locale.Details')}}">
                                                <i class="bi bi-display text-shadow"></i>
                                            </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('locale.Last 30 days Withdraw History')}}</h5>
                    <div id="withdraw-line"></div>
                </div>
            </div>
        </div>


    </div>

@include('admin.partials.cron')

@endsection

@push('breadcrumb-plugins')
@if($res['status'])
<a type="button" class="btn btn-warning" href="{{ route('admin.update') }}">New Update Released: V{{ $res['version'] }}</a>
@endif
<button type="button" class="btn cron @if(Carbon\Carbon::parse($general->last_cron_run)->diffInSeconds()<600)
        btn-success @elseif(Carbon\Carbon::parse($general->last_cron_run)->diffInSeconds()<1200) btn-warning @else
        btn-danger @endif "><i class="bi bi-clock"></i> {{ __('locale.Last Cron Run')}} : {{Carbon\Carbon::parse($general->last_cron_run)->difFforHumans()}}</button>
@endpush

@section('vendor-script')
{{-- vendor files --}}
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@push('script')
    @include('admin.partials.apexcharts')
@endpush
