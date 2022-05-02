@extends('frontend.layouts.blocks', [
    "subtitle" => "Alert your visitors about the use of cookies on your website. Comply with the hideous EU Cookie Law."
])

@section('title', __('Cookie Law'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.ui.cookielaw.themes", $attrs)
    @include ("frontend.ui.cookielaw.custom-css", $attrs)
    @include ("frontend.ui.cookielaw.informational", $attrs)
    @include ("frontend.ui.cookielaw.opt-out", $attrs)
    @include ("frontend.ui.cookielaw.opt-in", $attrs)
    @include ("frontend.ui.cookielaw.location", $attrs)

@endsection
