@extends('frontend.layouts.blocks', [
    "subtitle" => "Navigation available in Bootstrap share general markup and styles, from the base .nav class to the active and disabled states. Swap modifier classes to switch between each style."
])

@section('title', __("Navbar"))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.blocks.navbar.1", $attrs)
    @include ("frontend.blocks.navbar.2", $attrs)
    @include ("frontend.blocks.navbar.3", $attrs)
    @include ("frontend.blocks.navbar.4", $attrs)
    @include ("frontend.blocks.navbar.5", $attrs)
    @include ("frontend.blocks.navbar.6", $attrs)
    @include ("frontend.blocks.navbar.7", $attrs)

@endsection
