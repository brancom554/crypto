@extends('frontend.layouts.blocks', [
    "subtitle" => "Your customer have so much to say about your product and inspire your future customers to be part of circle of trust."
])

@section('title', __("Testimonials"))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.blocks.testimonials.1", $attrs )
    @include ("frontend.blocks.testimonials.2", $attrs )
    @include ("frontend.blocks.testimonials.3", $attrs )

@endsection
