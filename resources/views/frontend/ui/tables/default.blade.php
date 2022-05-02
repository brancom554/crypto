<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Basic</h2>
        <p class="lead italic">Using the most basic table markup, here’s how <code>.table</code>-based tables look in Bootstrap.</p>
    </div>

    @include ("frontend.ui.tables._table", ["class" => ""])
</x-utils.container>
