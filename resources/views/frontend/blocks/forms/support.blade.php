<!-- ./Support Form -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="device iphone-x">
                <div class="screen">
                    <img src="{{ asset('img/screens/app/1.png') }}" class="img-responsive" alt="">
                </div>
                <div class="notch"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="section-heading">
                <h2>@Lang('Awesome') <span class="bold">@Lang('Support')</span></h2>
                <p class="lead text-uppercase">@Lang('Enjoy with no worries')</p>
            </div>

            <p>@Lang('DashCore is fully supported, if you have recently experienced an issue, Hey! stay calm, we got you cover with our awesome support system').</p>
            <p>@Lang('Please contact our support team or write directly to our support email account').</p>

            <ul class="list-unstyled">
                <li>
                    <i class="fas fa-phone @rtl ms-3 @else me-3 @endrtl"></i>
                    (123) 456-7890
                </li>
                <li>
                    <i class="fas fa-envelope @rtl ms-3 @else me-3 @endrtl"></i>
                    <a href="mailto:youremail@domain.com">youremail@domain.com</a>
                </li>
            </ul>

            <x-forms.support />
        </div>
    </div>
</x-utils.container>
