@extends('frontend.layouts.blocks', [
    "subtitle" => "Documentation and examples for Bootstrap typography, including global settings, headings, body text, lists, and more."
])

@section('title', __('Typography'))

@php ($attrs = [
    'class' => 'block bg-contrast',
    'containerClass' => 'py-4'
])

@php (
    $elements = [
        [ "tag" => "mark", "class" => "mark", "text" => "You can use the mark tag to <mark>highlight</mark> text" ],
        [ "tag" => "del", "text" => "This line of text is meant to be treated as deleted text" ],
        [ "tag" => "s", "class" => "strike-through", "text" => "This line of text is meant to be treated as no longer accurate" ],
        [ "tag" => "ins", "text" => "This line of text is meant to be treated as an addition to the document" ],
        [ "tag" => "u", "class" => "underline", "text" => 'This line of text will render as underlined' ],
        [ "tag" => "small", "class" => "small", "text" => "This line of text is meant to be treated as fine print" ],
        [ "tag" => "em", "class" => "italic", "text" => "This line rendered as italicized text" ],
        [ "tag" => "span", "class" => "extra-bold", "text" => "This line rendered as extra-bold text" ],
        [ "tag" => "span", "class" => "bold", "text" => 'This line rendered as bold text' ],
        [ "tag" => "span", "class" => "regular", "text" => "This line rendered as regular text" ],
        [ "tag" => "span", "class" => "light", "text" => "This line rendered as light text" ],
        [ "tag" => "span", "class" => "thin", "text" => "This line rendered as thin text" ]
    ]
)

@php (
    $sizing = ['xs','sm','regular','l','md','lg','xl','xxl']
)

@section('main')

    @include ("frontend.ui.typography.headings", $attrs)
    @include ("frontend.ui.typography.display", $attrs)
    @include ("frontend.ui.typography.paragraphs", $attrs)
    @include ("frontend.ui.typography.sizing", $attrs + $sizing)
    @include ("frontend.ui.typography.inline", $attrs + $elements)

@endsection
