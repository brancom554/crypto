@extends('frontend.layouts.blocks', [
    "subtitle" => "Including a Contact Form? Try out one of the variations we bring you."
])

@section('title', __('Contact'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include('frontend.blocks.contact.1', $attrs)

@endsection
