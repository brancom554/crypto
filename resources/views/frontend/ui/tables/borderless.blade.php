<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Borderless table</h2>
        <p class="lead italic">Add <code>.table-borderless</code> for a table without borders.</p>
    </div>

    @include ("frontend.ui.tables._table", [ "class" => "table-borderless" ])
</x-utils.container>
