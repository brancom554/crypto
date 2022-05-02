@php( $steps = [
    [ "title" => "Account", "description" => "Account details", "icon" => "fa-lock" ],
    [ "title" => "Personal", "description" => "Personal information", "icon" => "fa-user" ],
    [ "title" => "Plan", "description" => "Your plan", "icon" => "fa-play" ],
    [ "title" => "Payment", "description" => "Credit card", "icon" => "fa-credit-card" ],
    [ "title" => "Confirm", "description" => "Proceed details", "icon" => "fa-check-square" ]
])
<!-- ./Wizard - Avanced Ajax Form Example -->
<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Advanced Ajax Form Example</h2>
        <p class="lead italic">In this example you can customize the form submission via ajax, additionally you can run form validations on every step change.</p>
        <p class="alert alert-info alert-icon shadow-sm rounded">
            <i class="icon fas fa-info-circle"></i>
            <small>Demo note: No request is saved or processed. All ajax call are just delayed by 2 secs to simulate
                a server process.</small>
        </p>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div id="form-wizard" class="wizard">
                <ul class="nav mb-5 justify-content-center">
                    @foreach ($steps as $step)
                    <li>
                        <a href="#fw-step-{{ $loop->index + 1 }}" class="nav-link" data-step="{{ $loop->index + 1 }}">
                            <i class="fas {{ $step['icon'] }}"></i>
                            <p class="bold my-0 desc">{{ $step['title'] }}</p>
                        </a>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach ($steps as $step)
                    <div id="fw-step-{{ $loop->index + 1 }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
