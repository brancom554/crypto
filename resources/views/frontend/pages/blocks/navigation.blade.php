@extends('frontend.layouts.blocks', [
    "subtitle" => "Navigation available in Bootstrap share general markup and styles, from the base .nav class to the active and disabled states. Swap modifier classes to switch between each style."
])

@section('title', __("Navigation"))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.blocks.navigation.list-dotted", $attrs)
    @include ("frontend.blocks.navigation.list-shadow", $attrs)
    @include ("frontend.blocks.navigation.list-solid", $attrs)

@endsection
