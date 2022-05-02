@extends('frontend.layouts.blocks', [
    "subtitle" => "Takes the basic nav and adds the <code>.nav-tabs</code> class to generate a tabbed interface. Use them to create tabbable regions with our tab JavaScript plugin."
])

@section('title', __('Tabs'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.ui.tabs.default", $attrs)
    @include ("frontend.ui.tabs.bordered", $attrs)
    @include ("frontend.ui.tabs.outlined", $attrs)
    @include ("frontend.ui.tabs.clean", $attrs)
    @include ("frontend.ui.tabs.vertical", $attrs)

@endsection
