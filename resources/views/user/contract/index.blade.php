@extends('layouts.app')
@section('content')
@if (Request::is('**/practice*'))
<livewire:practice-crypto-index />
@else
<livewire:crypto-index />
@endif

<div class="modal fade text-start" id="addWatchlist" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('locale.Add Crypto Currency')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('user.watchlist.store')}}" method="POST">
                <input type="hidden" id="inputfav" name="id">
                <div class="modal-body">
                    <p>{{ __('locale.Are you sure want to watchlist this coin')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                    <button type="submit" class="btn btn-success">{{ __('locale.Add')}}</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
<div id="deleteWatchlist" class="modal fade text-start" tabindex="-1" aria-hidden="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('locale.Delete Confirmation')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('user.watchlist.delete')}}" method="POST">
                @csrf
                <input type="hidden" id="bk" name="id">
                <div class="modal-body">
                    <p>{{ __('locale.Are you sure want to remove this coin from watchlist')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                    <button type="submit" class="btn btn-success">{{ __('locale.Delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if (Request::is('**/practice*'))
<div class="modal fade" id="practiceAmount">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('locale.Add Practice Balance')}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="deposit-form" action="{{route('user.add.practice.balance')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>{{ __('locale.Are you sure you want to add practice balance')}}?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm text-white btn-danger" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                    <button type="submit" class="btn btn-primary btn-sm text-white btn-success">{{ __('locale.Confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
