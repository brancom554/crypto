@extends('frontend.layouts.blocks', [
    "subtitle" => "Documentation and examples for opt-in styling of tables (given their prevalent use in JavaScript plugins) with Bootstrap."
])

@section('title', __('Tables'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.ui.tables.default", $attrs)
    @include ("frontend.ui.tables.striped", $attrs)
    @include ("frontend.ui.tables.bordered", $attrs)
    @include ("frontend.ui.tables.borderless", $attrs)
    @include ("frontend.ui.tables.hoverable", $attrs)
    @include ("frontend.ui.tables.responsive", $attrs)

@endsection
