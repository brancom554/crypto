@extends('frontend.layouts.blocks', [
    "subtitle" => "Documentation and examples for badges, our small count and labeling component."
])

@section('title', __('Badges'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
    'badges' => [
        "bootstrap" => ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'alternate', 'contrast', 'darker', 'black'],
        "sizes" => ['xs', 'sm', 'md', 'lg', 'xl'],
        "light" => ['contrast', 'outline-contrast', 'light', 'outline-light']
    ]
])

@section('main')

    @include ("frontend.ui.badges.solid", $attrs)
    @include ("frontend.ui.badges.outline", $attrs)
    @include ("frontend.ui.badges.rounded", $attrs)
    @include ("frontend.ui.badges.light", $attrs)
    @include ("frontend.ui.badges.scaling", $attrs)
    @include ("frontend.ui.badges.highlighting", $attrs)
    @include ("frontend.ui.badges.icons", $attrs)
    @include ("frontend.ui.badges.buttons", $attrs)

@endsection
