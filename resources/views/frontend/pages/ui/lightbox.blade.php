@extends('frontend.layouts.blocks', [
    "subtitle" => "Magnific Popup is a responsive lightbox & dialog script with focus on performance and providing best experience for user with any device."
])

@section('title', __('Lightbox and Dialog'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.ui.lightbox.single-image")
    @include ("frontend.ui.lightbox.gallery")
    @include ("frontend.ui.lightbox.video")
    @include ("frontend.ui.lightbox.dialog")
    @include ("frontend.ui.lightbox.form")
    @include ("frontend.ui.lightbox.ajax")

@endsection
