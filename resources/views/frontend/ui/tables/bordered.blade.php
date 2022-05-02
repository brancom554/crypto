<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Bordered table</h2>
        <p class="lead italic">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p>
    </div>

    @include ("frontend.ui.tables._table", [ "class" => "table-bordered" ])
</x-utils.container>
