@extends('frontend.layouts.blocks', [
    "subtitle" => "Multiple form elements to create awesome forms."
])

@section('title', __('Forms Elements'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.ui.form-controls.base", $attrs)

@endsection
