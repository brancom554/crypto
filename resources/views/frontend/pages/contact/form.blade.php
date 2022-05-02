<!-- ./Contact Us -->
<x-utils.container class="mt-n7" container-class="bring-to-front pt-0">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="shadow bg-contrast p-4 rounded">
                <x-forms.contact />
            </div>
        </div>

        <div class="col-md-5 @rtl me-md-auto @else ms-md-auto @endrtl">
            <div class="d-flex mt-5">
                <i class="fas fa-map-marker font-l text-primary @rtl ms-3 @else me-3 @endrtl"></i>
                <div class="flex-fill">
                    123 Street St, Your City,<span class="d-block">YC Country</span>
                </div>
            </div>

            <div class="d-flex my-4">
                <i class="fas fa-phone font-l text-primary @rtl ms-3 @else me-3 @endrtl"></i>
                <div class="flex-fill">
                    <span class="d-block"><a href="tel:+1-123-456-7890">(123) 456-7890</a></span>
                    <span class="d-block"><a href="tel:+1-987-654-3201">(987) 654-3201</a></span>
                </div>
            </div>

            <div class="d-flex">
                <i class="fas fa-envelope font-l text-primary @rtl ms-3 @else me-3 @endrtl"></i>
                <div class="flex-fill"><a href="mailto:support@5studios.net">support@5studios.net</a></div>
            </div>

            <hr class="my-4">

            <nav class="nav justify-content-center justify-content-md-start">
                <a href="#" class="btn btn-circle btn-secondary btn-sm @rtl ms-3 @else me-3 @endrtl"><i class="fab fa-facebook"></i></a>
                <a href="#" class="btn btn-circle btn-secondary btn-sm @rtl ms-3 @else me-3 @endrtl"><i class="fab fa-twitter"></i></a>
                <a href="#" class="btn btn-circle btn-secondary btn-sm"><i class="fab fa-instagram"></i></a>
            </nav>
        </div>
    </div>
</x-utils.container>
