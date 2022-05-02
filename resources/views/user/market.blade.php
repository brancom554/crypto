@extends('layouts.app')

@section('content')
    <div id="market"></div>
@endsection

@section('page-script')
  <script async src="{{ asset(mix('js/market.js')) }}"></script>
@endsection
