<!-- ./Contact -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="row gap-y">
            <div class="col-12 col-md-6">
                <div class="section-heading">
                    <p class="text-uppercase">Get in touch</p>
                    <h2 class="font-md bold">We'd like to hear from you</h2>
                </div>

                <p class="lead mb-5">Don't hesitate to get in contact with us no matter your request. We are here to help you.</p>

                <ul class="list-unstyled list-icon">
                    <li>
                        <i class="fas fa-map-marker text-primary @rtl ps-3 @endrtl"></i>
                        <p>123 Street, City, Country</p>
                    </li>
                    <li>
                        <i class="fas fa-phone text-primary @rtl ps-3 @endrtl"></i>
                        <p>(123) 456-7890</p>
                    </li>
                    <li>
                        <i class="fas fa-envelope text-primary @rtl ps-3 @endrtl"></i>
                        <p><a href="mailto:support@5studios.net">support@5studios.net</a></p>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-6">
                <x-forms.contact />
            </div>
        </div>
</x-utils.container>
