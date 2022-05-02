<!-- ./Lightbox - Ajax -->
<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Ajax Popup</h2>
        <p class="lead italic">You have full control of what is displayed in popup, align it to any side via CSS, enable or disable scroll on right side of window - whatever.</p>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto text-center">
            <a class="btn btn-outline-primary modal-popup" href="{{ route("frontend.ajax.content") }}" data-type="ajax">Load content via ajax</a>
        </div>
    </div>
</x-utils.container>
