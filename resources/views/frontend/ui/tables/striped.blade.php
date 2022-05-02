<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Striped rows</h2>
        <p class="lead italic">Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>tbody</code>.</p>
    </div>

    @include ("frontend.ui.tables._table", [ "class" => "table-striped" ])
</x-utils.container>
