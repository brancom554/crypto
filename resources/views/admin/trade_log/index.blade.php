@extends('layouts.app')
@section('content')
<div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Trade Logs</h4><div class="card-search"></div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover custom-data-bs-table">
                    <thead class="table-dark">
                            <tr>
                                <th scope="col">{{ __('locale.ID')}}</th>
                                <th scope="col">{{ __('locale.Username')}}</th>
                                <th scope="col">{{ __('locale.Crypto Currency')}}</th>
                                <th scope="col">{{ __('locale.Crypto Symbol')}}</th>
                                <th scope="col">{{ __('locale.Amount')}}</th>
                                <th scope="col">{{ __('locale.In Time')}}</th>
                                <th scope="col">{{ __('locale.HighLow')}}</th>
                                <th scope="col">{{ __('locale.Result')}}</th>
                                <th scope="col">{{ __('locale.Status')}}</th>
                                <th scope="col">{{ __('locale.Date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tradelogs as $tradelog)
                            <tr>
                                <td data-label="{{ __('locale.ID')}}">{{__($loop->iteration)}}</td>
                                <td data-label="{{ __('locale.Username')}}"><a href="{{ route('admin.users.detail', $tradelog->user_id) }}">{{ $tradelog->user->username }}</a></td>
                                <td data-label="{{ __('locale.Crypto Currency')}}" class="text-uppercase">{{__($tradelog->crypto->name)}}</td>
                                <td data-label="{{ __('locale.Crypto Symbol')}}" class="text-uppercase">{{__($tradelog->crypto->symbol)}}</td>
                                <td data-label="{{ __('locale.Amount')}}">{{__(getAmount($tradelog->amount))}} {{$general->cur_text}}</td>
                                <td data-label="{{ __('locale.In Time')}}">{{showDateTime($tradelog->in_time, 'd M, Y h:i:s')}}</td>
                                <td data-label="{{ __('locale.High Low')}}">
                                    @if($tradelog->hilow == 1)
                                        <span class="badge bg-success">{{ __('locale.High')}}</span>
                                    @elseif($tradelog->hilow == 2)
                                        <span class="badge bg-danger">{{ __('locale.Low')}}</span>
                                    @endif
                                </td>
                                <td data-label="{{ __('locale.Result')}}">
                                    @if($tradelog->result == 1)
                                        <span class="badge bg-success">{{ __('locale.Win')}}</span>
                                    @elseif($tradelog->result == 2)
                                        <span class="badge bg-danger">{{ __('locale.Lose')}}</span>
                                    @elseif($tradelog->result == 3)
                                        <span class="badge bg-warning">{{ __('locale.Draw')}}</span>
                                    @else
                                        <span class="badge bg-warning">{{ __('locale.Pending')}}</span>
                                    @endif
                                </td>
                                <td data-label="{{ __('locale.Status')}}">
                                    @if($tradelog->status == 0)
                                        <span class="badge bg-primary">{{ __('locale.Running')}}</span>
                                    @elseif($tradelog->status == 1)
                                        <span class="badge bg-success">{{ __('locale.Complete')}}</span>
                                    @endif
                                </td>
                                <td data-label="{{ __('locale.Date')}}">{{showDateTime($tradelog->created_at, 'd M, Y h:i:s')}}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{__($empty_message) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
            </div>

            <div class="mb-1">{{paginateLinks($tradelogs) }}</div>
        </div>
    </div>
@endsection
