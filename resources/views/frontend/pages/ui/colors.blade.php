@extends('frontend.layouts.blocks', [
    "subtitle" => "Convey meaning through color with a handful of color utility classes. Includes support for styling links with hover states, too."
])

@section('title', __('Colors'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
    "colors" => [
        "bootstrap" => [
            [ "name" => "primary", "text" => "white" ],
            [ "name" => "secondary", "text" => "white" ],
            [ "name" => "success", "text" => "white" ],
            [ "name" => "danger", "text" => "white" ],
            [ "name" => "warning", "text" => "white" ],
            [ "name" => "info", "text" => "white" ],
            [ "name" => "light", "text" => "dark" ],
            [ "name" => "dark", "text" => "white" ],

            [ "name" => "alternate", "text" => "white" ],
            [ "name" => "contrast", "text" => "dark" ],
            [ "name" => "darker", "text" => "dark" ],
            [ "name" => "black", "text" => "dark" ]
        ],
        "text" => [
            [ "name" => "primary" ],
            [ "name" => "secondary" ],
            [ "name" => "success" ],
            [ "name" => "danger" ],
            [ "name" => "warning" ],
            [ "name" => "info" ],
            [ "name" => "light", "bg" => "dark" ],
            [ "name" => "dark" ],

            [ "name" => "body" ],
            [ "name" => "muted" ],
            [ "name" => "white", "bg" => "dark" ],
            [ "name" => "'black-50" ],
            [ "name" => "'white-50", "bg" => "dark" ],

            [ "name" => "alternate" ],
            [ "name" => "contrast", "bg" => "dark" ],
            [ "name" => "darker" ],
            [ "name" => "black" ]
        ],
        "gradients" => [
            [ "base" => "purple", "variants" => ["blue", "dark", "navy"] ],
            [ "base" => "blue", "variants" => ["purple", "dark", "navy"] ],
            [ "base" => "navy", "variants" => ["blue", "purple"] ],
            [ "base" => "primary", "variants" => ["dark", "light"] ]
        ]
    ]
])

@section('main')

    @include('frontend.ui.colors.text', $attrs)
    @include('frontend.ui.colors.default', $attrs)
    @include('frontend.ui.colors.gradient', $attrs)
    @include('frontend.ui.colors.alpha', $attrs)

@endsection
