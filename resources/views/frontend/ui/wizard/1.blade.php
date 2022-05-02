<!-- ./Wizard - Basic example -->
<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Basic example</h2>
        <p class="lead italic">This example shows you how to simple initialize the wizard.</p>
    </div>

    <div id="basic-wizard" class="wizard">
        <ul class="nav mb-5 justify-content-center">
            @foreach ($steps as $step)
            <li>
                <a href="#bw-step-{{ $loop->index }}" class="nav-link">
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
            <div id="bw-step-{{ $loop->index }}" class="tab-pane">
                @include ("frontend.ui.wizard.cards.{$view}", $attrs)
            </div>
            @endforeach
        </div>
    </div>
</x-utils.container>
