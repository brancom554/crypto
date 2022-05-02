@extends('frontend.layouts.blocks', [
    "subtitle" => "Pick from multiple forms to provide your users interaction with you no matter their regards."
])

@section('title', __("Forms"))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.blocks.forms.register-input-group", $attrs)
    @include ("frontend.blocks.forms.register-trial", $attrs)
    @include ("frontend.blocks.forms.support", $attrs)

@endsection
