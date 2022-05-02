<!-- ./Footer - Social + Subscription -->
<footer class="site-footer section {{ $class ?? '' }}">
    <div class="bg-darker">
        <div class="container text-center {{ $containerClass ?? '' }}">
            <nav class="nav justify-content-center my-4">
                <x-utils.link class="@rtl ms-4 @else me-4 @endrtl font-regular text-contrast" icon="fab fa-facebook" text="/5studios.net" />
                <x-utils.link class="@rtl ms-4 @else me-4 @endrtl font-regular text-contrast" icon="fab fa-twitter-square" text="/5studios.net" />
                <x-utils.link class="@rtl ms-4 @else me-4 @endrtl font-regular text-contrast" icon="fab fa-linkedin" text="/5studios.net" />
                <x-utils.link class="font-regular text-contrast" icon="fab fa-instagram" text="/5studios.net" />
            </nav>
        </div>
    </div>

    <div class="container {{ $containerClass ?? '' }}">
        <div class="row gap-y">
            <div class="col-md-4">
                <img src="{{ asset('img/logo.png') }}" alt="" class="logo">

                <nav class="nav mt-4">
                    <a href="#" class="@rtl ms-3 @else me-3 @endrtl">@Lang('About us')</a>
                    <a href="#" class="@rtl ms-3 @else me-3 @endrtl">@Lang('Our process')</a>
                    <a href="#" class="@rtl ms-3 @else me-3 @endrtl">@Lang('Contact us')</a>
                </nav>

                <p class="mb-0 small text-secondary">Copyright © 2021. @Lang('All rights reserved'). <a href="https://5studios.net" target="_blank">5studios.net</a></p>
            </div>

            <div class="col-md-4">
                <h6 class="bold">@Lang('Your Office')</h6>
                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur elit. Blanditiis commodi expedita, odit officiis?</p>

                <nav class="nav flex-column small">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker @rtl ms-2 @else me-2 @endrtl"></i> 123 Street St, Your City, YC Your Country
                    </div>
                    <div class="mt-2 d-flex align-items-center">
                        <i class="fas fa-phone @rtl ms-2 @else me-2 @endrtl"></i> (123) 456-7890
                    </div>
                    <div class="mt-2 d-flex align-items-center">
                        <i class="fas fa-envelope @rtl ms-2 @else me-2 @endrtl"></i> <a
                            href="mailto:yourmail@domain.com">yourmail@domain.com</a>
                    </div>
                </nav>
            </div>

            <div class="col-md-4">
                <h6 class="bold">@Lang('Subscribe to our newsletter')</h6>
                <p class="text-secondary">@Lang('By registering with us, you will receive right in your inbox all new features and updates'). <span class="bold">@Lang('Subscribe now')!</span></p>

                <x-forms.register-input-group color="dark"/>
            </div>
        </div>

        <hr>
        <nav class="nav small">
            <a href="#" class="text-secondary @rtl ms-3 @else me-3 @endrtl">@Lang('Privacy policy')</a>
            <a href="#" class="text-secondary">@Lang('Terms')</a>
        </nav>
    </div>
</footer>
