<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Default</h2>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            @include ("frontend.ui.tabs._content", [ "id" => "default", "class" => "nav-tabs" ])
        </div>
    </div>
</x-utils.container>
