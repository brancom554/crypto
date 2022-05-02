@extends('frontend.layouts.master')

@section('layout')
@include('frontend.sections.header')

    <main class="overflow-hidden {{ $mainClass ?? '' }}">
        @yield('content')
        @yield('footer')
    </main>
@endsection
