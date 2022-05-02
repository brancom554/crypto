<!-- ./Wizard - Simple Ajax example -->
<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Simple Ajax example</h2>
        <p class="lead italic">This example shows you how to load the wizard step by using ajax calls.</p>
    </div>

    <div id="ajax-wizard" class="wizard">
        <ul class="nav mb-5 justify-content-center">
            @foreach ($steps as $step)
            <li>
                <a href="#aw-step-{{ $loop->index + 1 }}" class="nav-link" data-step="{{ $loop->index + 1 }}">
                    <i class="fas {{ $step['icon'] }} mb-2"></i>
                    <p class="bold my-0">{{ $step['title'] }}</p>
                    <span class="small text-secondary">{{ $step['description'] }}</span>
                </a>
            </li>
            @endforeach
        </ul>

        <div class="mb-5 tab-content">
            @foreach ($steps as $step)
            @php ($view = $loop->index + 1)
            <div id="aw-step-{{ $view }}" class="tab-pane">
                @if ($view == 1)
                    @include ("frontend.ui.wizard.clean.{$view}")
                @endif
            </div>
            @endforeach
        </div>
    </div>
</x-utils.container>
