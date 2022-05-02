@extends('frontend.layouts.blocks', [
    "subtitle" => "An overlay is an alpha layer that is superimposed as a top layer over the content being overlayed."
])

@section('title', __('Overlay'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
    "overlays" => [
        [ "name" => "primary", "color" => "contrast" ],
        [ "name" => "secondary", "color" => "contrast" ],
        [ "name" => "success", "color" => "contrast" ],
        [ "name" => "danger", "color" => "contrast" ],
        [ "name" => "warning", "color" => "contrast" ],
        [ "name" => "info", "color" => "contrast" ],
        [ "name" => "light", "color" => "dark" ],
        [ "name" => "dark", "color" => "contrast" ],

        [ "name" => "alternate", "color" => "contrast" ],
        [ "name" => "contrast", "color" => "dark" ],
        [ "name" => "darker", "color" => "contrast" ],
        [ "name" => "black", "color" => "contrast" ]
    ]
])

@section('main')

    @include ("frontend.ui.overlay.default", $attrs)
    @include ("frontend.ui.overlay.gradients", $attrs)

@endsection
