<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Bordered</h2>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            @include ("frontend.ui.tabs._content", [ "id" => "bordered", "class" => "nav-tabs tabs-bordered" ])
        </div>
    </div>
</x-utils.container>
