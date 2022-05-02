@extends('frontend.layouts.blocks', [
    "subtitle" => "Wizards help you to make a sequel of interaction more user-friendly and also visually appealing for the users."
])

@section('title', __('Wizard'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@php ([
    $steps = [
        [ "title" => "Step 1", "description" => "This is step description", "icon" => "fa-lock" ],
        [ "title" => "Step 2", "description" => "This is step description", "icon" => "fa-user" ],
        [ "title" => "Step 3", "description" => "This is step description", "icon" => "fa-credit-card" ],
        [ "title" => "Step 4", "description" => "This is step description", "icon" => "fa-check-square" ]
    ]
])

@section('main')

    @include ("frontend.ui.wizard.1", $attrs + $steps)
    @include ("frontend.ui.wizard.2", $attrs + $steps)
    @include ("frontend.ui.wizard.3", $attrs)

@endsection
