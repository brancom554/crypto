<!-- ./Start with Dashcore - Swiper -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row align-items-end">
        <div class="col-lg-4">
            <h2 class="light">@Lang('Start the right way')<br><span class="bold">@Lang('Start with '){{ appName() }}</span></h2>
            <p class="lead text-secondary">@Lang('Thinking about a new project? Start in no time with the tools') {{ appName() }} @Lang('brings to you').</p>

            <a href="pricing.html" class="btn btn-primary btn-rounded mt-4">@Lang('Choose the right plan')
                <i class="ms-3 fas fa-long-arrow-alt-right"></i>
            </a>

            <hr class="mt-5 mb-4">

            <ol id="sw-nav-tools" class="nav nav-process nav-circle nav-justified @rtl pe-0 @endrtl">
                @php ($elements = ['Inbox', 'Calendar', 'Invoicing', 'Reporting'])
                @foreach ($elements as $element)
                <li class="nav-item{{ $loop->index == 0 ? " active" : "" }}">
                    <a class="nav-link" href="#" data-step="{{ $loop->index + 1 }}">
                        <small class="mt-4 absolute">{{ $element }}</small>
                    </a>
                </li>
                @endforeach
            </ol>
        </div>

        <div class="col-lg-7 ms-lg-auto">
            <div class="browser shadow mt-4 mt-md-0">
                <div class="swiper-container" data-sw-navigation="#sw-nav-tools">
                    <div class="swiper-wrapper">
                        @for ($i = 1; $i < 5; $i++)
                        <div class="swiper-slide">
                            <img src="{{ asset("img/screens/dash/{$i}.png") }}" alt="" class="img-responsive">
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
