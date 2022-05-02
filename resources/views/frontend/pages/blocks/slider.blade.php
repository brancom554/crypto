@extends('frontend.layouts.blocks', [
    "subtitle" => "An element of a web page that displays multiple images and text alternate between them."
])

@section('title', __("Sliders"))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
])

@section('main')

    @include ("frontend.blocks.sliders.1", $attrs)
    @include ("frontend.blocks.sliders.2", $attrs)
    @include ("frontend.blocks.sliders.3", $attrs)
    @include ("frontend.blocks.sliders.4", $attrs)
    @include ("frontend.blocks.sliders.5", $attrs)

@endsection
