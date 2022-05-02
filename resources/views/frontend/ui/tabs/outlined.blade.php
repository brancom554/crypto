<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Outlined</h2>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            @include ("frontend.ui.tabs._content", [ "id" => "outlined", "class" => "nav-tabs nav-outlined nav-rounded" ])
        </div>
    </div>
</x-utils.container>
