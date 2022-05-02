@extends('frontend.layouts.app', [
    "useDarkLinks" => true,
    "useOnlyDarkLogo" => true
])

@section('title', __('Payment Services'))

@section('content')
    @include ("frontend.sections.heading")

    @include ("frontend.sections.credit-cards")
    @include ("frontend.sections.gifts")
    @include ("frontend.sections.security")
    @include ("frontend.sections.wallets")

    @include ("frontend.sections.features")
    @include ("frontend.sections.partners")
    @include ("frontend.sections.testimonials")
    @include ("frontend.sections.faqs")
    @include ("frontend.sections.try-it")

@endsection

@section('footer')
    @include ("frontend.sections.footer", [ "containerClass" => "pb-4" ])
@endsection
