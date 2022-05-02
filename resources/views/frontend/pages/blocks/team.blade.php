@extends('frontend.layouts.blocks', [
    "subtitle" => "Reveal the people behind your product with these design blocks."
])

@section('title', __("Team"))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
    'team' => [
        [ "name" => "Rafael Freeman", "position" => "Founder & CEO", "quote" => "Long time ago, this guy started it all.", "social" => ["facebook", "twitter", "dribbble"], "onStatic" => true ],
        [ "name" => "Aline De Souza", "position" => "Marketing Director", "quote" => "The girl that influences our products.", "social" => ["facebook", "twitter", "dribbble"], "onStatic" => true ],
        [ "name" => "Jayden Gardner", "position" => "Account Manager", "quote" => "The guy that keeps all the numbers in place.", "social" => ["facebook", "twitter", "dribbble"], "onStatic" => true ],
        [ "name" => "Jacobi Edwards", "position" => "VP of Sales", "quote" => "The man that leads the Global Sales team.", "social" => ["facebook", "twitter", "dribbble"], "onStatic" => true ],
        [ "name" => "Allison Fernandez", "position" => "Client Support", "quote" => "Need any assistance with the product?", "social" => ["facebook", "twitter", "dribbble"], "onStatic" => false ],
        [ "name" => "Richard Smith", "position" => "Lead Developer", "quote" => "Geek, manager, and manager of geeks.", "social" => ["facebook", "twitter", "dribbble"], "onStatic" => false ]
    ]
])

@section('main')

    @include ("frontend.blocks.team.1", $attrs )
    @include ("frontend.blocks.team.2", $attrs )
    @include ("frontend.blocks.team.3", $attrs )
    @include ("frontend.blocks.team.4", $attrs )

@endsection
