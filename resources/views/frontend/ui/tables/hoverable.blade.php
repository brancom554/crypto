<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Hoverable rows</h2>
        <p class="lead italic">Add <code>.table-hover</code> to enable a hover state on table rows within a <code>tbody</code>.</p>
    </div>

    @include ("frontend.ui.tables._table", [ "class" => "table-hover" ])
</x-utils.container>
