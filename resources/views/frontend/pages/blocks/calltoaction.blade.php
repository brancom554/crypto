@extends('frontend.layouts.blocks', [
    "subtitle" => "Encourage consumers to take prompt actions by using advertising messages."
])

@section('title', __('Call to Actions'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include('frontend.blocks.cta.1', $attrs)
    @include('frontend.blocks.cta.2', $attrs)
    @include('frontend.blocks.cta.3', $attrs)
    @include('frontend.blocks.cta.4', $attrs)

@endsection
