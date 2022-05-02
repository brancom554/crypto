<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Paragraph</h2>
        <p class="lead italic">Multiple options for styling your paragraphs text.</p>
    </div>

    <p class="b-b pb-2 mb-4 text-primary">Default</p>
    <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.
    </p>

    <p class="b-b pb-2 my-4 text-primary">Lead</p>
    <p class="lead">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non
        commodo luctus.</p>

    <p class="b-b pb-2 my-4 text-primary">Small</p>
    <p class="small">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non
        commodo luctus.</p>
</x-utils.container>
