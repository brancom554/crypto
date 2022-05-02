@extends('frontend.layouts.blocks', [
    "subtitle" => "Provide contextual feedback messages for typical user actions with the handful of available and flexible alert messages."
])

@section('title', __('Alerts'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
    "alerts" => [
        "icons" => [
            [ "name" => "primary", "icon" => "info-circle" ],
            [ "name" => "secondary", "icon" => "check-circle" ],
            [ "name" => "success", "icon" => "check" ],
            [ "name" => "danger", "icon" => "exclamation-circle" ],
            [ "name" => "warning", "icon" => "exclamation-triangle" ],
            [ "name" => "info", "icon" => "info-circle" ],
            [ "name" => "light", "icon" => "info" ],
            [ "name" => "dark", "icon" => "check-circle" ],
            [ "name" => "alternate", "icon" => "check-circle" ],
            [ "name" => "contrast", "icon" => "check-circle" ],
            [ "name" => "darker", "icon" => "check-circle" ],
            [ "name" => "black", "icon" => "check-circle" ]
        ],
        "bootstrap" => ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'alternate', 'contrast', 'darker', 'black'],
        "theme" => [ '1', '2', '3', '4', '5', '6'],
        "sizes" => ['xs', 'sm', 'md', 'lg', 'xl'],
        "light" => ['1', 'outline-1', 'outline-6', 'outline-light']
    ]
])

@section('main')

    @include('frontend.ui.alerts.default', $attrs)
    @include('frontend.ui.alerts.additional-content', $attrs)
    @include('frontend.ui.alerts.dismiss', $attrs)
    @include('frontend.ui.alerts.icons', $attrs)
    @include('frontend.ui.alerts.outline', $attrs)
    @include('frontend.ui.alerts.thin', $attrs)

@endsection
