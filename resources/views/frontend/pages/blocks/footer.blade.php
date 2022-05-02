@extends('frontend.layouts.blocks', [
    "subtitle" => "A line of information placed at the end of a page for purposes of identification."
])

@section('title', __("Footers"))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@section('main')

    @include ("frontend.blocks.footers.4cols", $attrs)
    @include ("frontend.blocks.footers.5cols", $attrs)
    @include ("frontend.blocks.footers.next", $attrs)
    @include ("frontend.blocks.footers.simple-3cols", $attrs)
    @include ("frontend.blocks.footers.stay-in-touch", $attrs)
    @include ("frontend.blocks.footers.yalp", $attrs)

@endsection
