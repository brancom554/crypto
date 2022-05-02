<!-- ./Lightbox - Form -->
<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Popup with Form</h2>
        <p class="lead">Entered data is not lost if you open and close the popup or if you go to another page and
            then press back browser button.</p>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto text-center">
            <a class="btn btn-outline-primary modal-popup" href="#modal-form" data-effect="mfp-zoom-in" data-focus="#signup_username">
                Open form
            </a>

            <!-- dialog itself, mfp-hide class is required to make dialog hidden -->
            <div id="modal-form" class="container mfp-with-anim mfp-hide popup-wrapper bg-contrast">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <p class="alert alert-icon alert-primary mb-5">
                            <i class="icon fas fa-info-circle"></i>
                            <small>The following example shows a modal form with auto focused input</small>
                        </p>

                        <x-forms.contact />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
