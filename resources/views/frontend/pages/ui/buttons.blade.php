@extends('frontend.layouts.blocks', [
    "subtitle" => "Use Bootstrap’s custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more."
])

@section('title', __('Buttons'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
    "buttons" => [
        "bootstrap" => [
            [ "name" => 'primary' ],
            [ "name" => 'secondary' ],
            [ "name" => 'success' ],
            [ "name" => 'danger' ],
            [ "name" => 'warning' ],
            [ "name" => 'info' ],
            [ "name" => 'light' ],
            [ "name" => 'dark' ],
            [ "name" => 'link' ],
            [ "name" => 'alternate' ],
            [ "name" => 'contrast' ],
            [ "name" => 'darker' ],
            [ "name" => 'black' ]
        ],
        "sizes" => ['sm', 'md', 'lg']
    ]
])

@section('main')

    @include('frontend.ui.buttons.solid', $attrs)
    @include('frontend.ui.buttons.outline', $attrs)
    @include('frontend.ui.buttons.rounded', $attrs)
    @include('frontend.ui.buttons.circle', $attrs)
    @include('frontend.ui.buttons.sized', $attrs)

@endsection
