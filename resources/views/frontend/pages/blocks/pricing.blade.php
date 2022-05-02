@extends('frontend.layouts.blocks', [
    "subtitle" => "Display your solution prices when it comes to a non-free product."
])

@section('title', __("Pricing"))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4',
])

@php ($plans = [
    'plans' => [[
        "icon" => "box",
        "plan" => [
            "name" => "Personal",
            "price" => [ "monthly" => 0.99, "yearly" => 0.78 ],
            "description" => "For individuals & small business."
        ],
        "features" => [[
            "name" => "Cras justo odio",
            "class" => "strike-through"
            ], [
                "name" => "Dapibus ac facilisis in",
                "class" => "strike-through"
            ], [
                "name" => "Morbi leo risus",
                "class" => "strike-through"
            ], [
                "name" => "Porta ac consectetur ac"
            ], [
                "name" => "Vestibulum at eros"
            ]
        ]
    ], [
        "icon" => "download-cloud",
        "best" => true,
        "plan" => [
            "name" => "Business",
            "price" => [ "monthly" => 19.99, "yearly" => 15.98 ],
            "description" => "For growing companies."
        ],
        "features" => [[
                "name" => "Cras justo odio",
                "class" => "strike-through"
            ], [
                "name" => "Dapibus ac facilisis in",
                "class" => "strike-through"
            ], [
                "name" => "Morbi leo risus"
            ], [
                "name" => "Porta ac consectetur ac"
            ], [
                "name" => "Vestibulum at eros"
            ]
        ]
    ], [
        "icon" => "settings",
        "plan" => [
            "name" => "Enterprise",
            "price" => ["monthly" => 99.99, "yearly" => 75.99],
            "description" => "For enterprise teams."
        ],
        "features" => [[
                "name" => "Cras justo odio"
            ], [
                "name" => "Dapibus ac facilisis in"
            ], [
                "name" => "Morbi leo risus"
            ], [
                "name" => "Porta ac consectetur ac"
            ], [
                "name" => "Vestibulum at eros"
            ]
        ]
    ]]
])

@section('main')

    @include ("frontend.blocks.pricing.1", $attrs + $plans)
    @include ("frontend.blocks.pricing.2", $attrs + $plans)
    @include ("frontend.blocks.pricing.3", $attrs + $plans)
    @include ("frontend.blocks.pricing.4", $attrs + $plans)
    @include ("frontend.blocks.pricing.5", $attrs + $plans)
    @include ("frontend.blocks.pricing.table", $attrs)

@endsection
