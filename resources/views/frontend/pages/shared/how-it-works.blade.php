<!-- ./Tools for everyone - Swiper -->
<x-utils.container class="border-bottom border-top bg-light">
    <div class="section-heading text-center">
        <i data-feather="sliders" width="36" height="36" class="stroke-primary"></i>
        <h2 class="bold">Tools for everyone</h2>
        <p class="lead text-muted">Get ready in no time... just like 1, 2 & 3.</p>
    </div>

    <div class="row align-items-end">
        <div class="col-lg-4 @rtl text-end @endif">
            <h2 class="bold">Start the right way<br><span class="light">Start with {{ appName() }}</span></h2>
            <p class="lead text-secondary">Thinking about a new project? Start in no time with the tools {{ appName() }} brings to you.</p>

            <a href="pricing" class="btn btn-primary btn-rounded mt-4">Choose the right plan
                <i class="fas @rtl fa-long-arrow-alt-left me-3 @else fa-long-arrow-alt-right ms-3 @endrtl"></i>
            </a>

            <ol id="sw-nav-tools" class="nav nav-process nav-circle nav-justified mt-5 @rtl pe-0 @endrtl">
                @php ($elements = ['Inbox', 'Calendar', 'Invoicing', 'Reporting'])
                @foreach ($elements as $e)
                <li class="nav-item @if($loop->index == 0) active @endif">
                    <a class="nav-link" href="#" data-step="{{ $loop->index + 1 }}">
                        <small class="mt-4 absolute">{{ $e }}</small>
                    </a>
                </li>
                @endforeach
            </ol>
        </div>

        <div class="col-lg-7 @rtl me-lg-auto @else ms-lg-auto @endrtl">
            <div class="browser shadow mt-4 mt-md-0" data-aos="@rtl fade-right @else fade-left @endrtl">
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
