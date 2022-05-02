@extends('frontend.layouts.blocks', [
    "subtitle" => "Animated text counter for everything number you want show off."
])

@section('title', __('Counters'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.blocks.counters.1", $attrs)
    @include ("frontend.blocks.counters.2", $attrs)
    @include ("frontend.blocks.counters.3", $attrs)
    @include ("frontend.blocks.counters.4", $attrs)

@endsection
