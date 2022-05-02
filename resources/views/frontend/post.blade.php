@extends('frontend.layouts.app')

@section('title', __('Blog'))

@section('content')
@php
    $page_title = "Blog";
@endphp
    @include("frontend.blog.heading.fullscreen")
    @include("blogetc::partials.show_errors")
    @include("frontend.blog.post")
@endsection

@section('footer')
    @include("frontend.sections.footer", [ "class" => "border-top", "containerClass" => "pb-3" ])
@endsection
