<!-- ./Lightbox - Dialog -->
<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Dialog with CSS animation</h2>
        <p class="lead italic">Animations are added with simple CSS transitions, you can make them look however you wish.
        </p>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto text-center">
            <p>Open dialog with animation</p>
            @php ($effects = ['zoom-in', 'newspaper', 'move-horizontal', 'move-from-top', '3d-unfold', 'zoom-out'])

            <nav class="d-flex justify-content-between">
                @foreach ($effects as $e)
                <a class="btn btn-outline-primary modal-popup" href="#modal-dialog" data-effect="mfp-{{ $e }}">
                    {{ $e }}
                </a>
                @endforeach
            </nav>

            <!-- Dialog itself, mfp-hide class is required to make dialog hidden -->
            <div id="modal-dialog" class="section mfp-with-anim mfp-hide popup-wrapper bg-contrast">
                <div class="container">
                    <h2>Dialog example</h2>
                    <p>This is dummy copy. It is not meant to be read. It has been placed here solely to demonstrate
                        the look and feel of finished, typeset text. Only for show. He who searches for meaning here
                        will be sorely disappointed.</p>
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
