@extends('layouts.app')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/base/pages/page-blog.css') }}" />
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-md-8">
        @yield('blogfront')
    </div>
    <div class="col-lg-4 col-md-4">
        @include('blog.blog-sidebar')
    </div>
</div>

@endsection
