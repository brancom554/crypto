@extends('frontend.layouts.pages')

@section('title', __('Blog'))

@php ($attrs = ["posts" => [
    [ "title" => "Discover the Beauty of DashCore", "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi at, cumque dolores dolorum est.", "author" => "Jenny Oliver", "gravity" => 'north', "favorite" => [ "icon" => 'fas fa-heart text-danger', "count" => 347 ], "bookmark" => [ "icon" => 'far fa-bookmark', "count" => 73 ] ],
    [ "title" => "Extending DashCore Template", "description" => "Cupiditate debitis delectus dolor dolore doloremque, doloribus eveniet illo in labore neque numquam.", "author" => "Jennifer Wells", "gravity" => 'south', "favorite" => [ "icon" => 'far fa-heart', "count" => 415 ], "bookmark" => [ "icon" => 'fas fa-bookmark text-warning', "count" => 98 ] ],
    [ "title" => "5 Reasons to Choose DashCore", "description" => "Amet aperiam cumque delectus eligendi, esse, modi nemo nisi officiis rem repellat sed ulla.", "author" => "Roger Sanchez", "gravity" => 'east', "favorite" => [ "icon" => 'far fa-heart', "count" => 152 ], "bookmark" => [ "icon" => 'far fa-bookmark', "count" => 13 ] ],
    [ "title" => "Extending DashCore Template", "description" => "Amet animi autem commodi, debitis dolore doloribus fugiat illum molestias nesciunt perspiciatis.", "author" => "Billie Ramos", "gravity" => 'east', "favorite" => [ "icon" => 'fas fa-heart text-danger', "count" => 731 ], "bookmark" => [ "icon" => 'far fa-bookmark', "count" => 83 ] ]
]])

@section('content')
    <x-frontend.header
        title="Dashcore Blog"
        subtitle="Here's some reasons why Dashcore is your best choice when picking a template." />

    <x-utils.divider color="contrast" />

    @include ("frontend.blog.post-right-sidebar", $attrs)
@endsection

@section('footer')
    @include("frontend.blocks.footers.4cols", [ "class" => "border-top", "containerClass" => "pb-3" ])
@endsection
