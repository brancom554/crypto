@extends('frontend.layouts.blocks', [
    "subtitle" => "Progress elements to be used in multiple creative ways."
])

@section('title', __('Progress'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
    "bars" => [
        [ "value" => 0, "size" => "progress-sl", "style" => "progress-3" ],
        [ "value" => 25, "size" => "progress-ty", "style" => "progress-danger" ],
        [ "value" => 50, "size" => "progress-xs", "style" => "progress-4" ],
        [ "value" => 75, "size" => "progress-sm", "style" => "progress-warning" ],
        [ "value" => 100, "size" => "progress-md", "style" => "progress-success" ]
    ]
])

@section('main')

    @include ("frontend.ui.progress.1", $attrs)
    @include ("frontend.ui.progress.2", $attrs)
    @include ("frontend.ui.progress.3", $attrs)
    @include ("frontend.ui.progress.4", $attrs)
    @include ("frontend.ui.progress.5", $attrs)

@endsection
