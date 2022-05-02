@extends('frontend.layouts.app')

@section('title', __('Blog'))
@section('content')
@php
    $page_title = "Blog";
@endphp
    <x-frontend.header
        title="{{ siteName() }} Blog"
        subtitle="What our awesome community is talking about." />

    <x-utils.divider color="contrast" />

    <x-utils.container>
    <div class="row">
        <div class="col-lg-8 col-md-8">
            @yield('blogfront')
        </div>
        <div class="col-lg-4 col-md-4">
            @include('blog.blog-sidebar')
        </div>
    </div>
</x-utils.container>
@endsection

@section('footer')
    @include("frontend.sections.footer", [ "class" => "border-top", "containerClass" => "pb-3" ])
@endsection
