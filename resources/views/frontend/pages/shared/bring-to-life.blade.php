<!-- ./Bring to life - Swiper -->
<x-utils.container class="bg-light" container-class="bring-to-front">
    <div class="row gap-y">
        <div class="col-md-6">
            <div class="rounded bg-primary-gradient shadow">
                <div class="d-flex flex-column align-items-center py-3">
                    <img src="{{ asset("img/bg/asset-1.svg") }}" class="img-responsive w-50" alt="">
                </div>
            </div>

            <div class="rounded shadow-box bg-contrast mt-4">
                <div class="d-flex align-items-center px-3">
                    <i data-feather="bar-chart" class="stroke-primary @rtl ms-3 @else me-3 @endrtl" width="36" height="36"></i>
                    <div class="flex-fill my-3 @rtl pe-3 b-r @else ps-3 b-l @endrtl">
                        <p class="bold text-primary my-0">Admin template included</p>
                        <p class="my-0 text-secondary">We've included a fully functional starter admin dashboard</p>
                    </div>
                </div>
            </div>

            <div class="rounded shadow-box bg-contrast mt-4">
                <div class="d-flex align-items-center px-3">
                    <i data-feather="smartphone" width="36" height="36" class="stroke-primary @rtl ms @else me-3 @endrtl"></i>
                    <div class="flex-fill my-3 @rtl pe-3 b-r @else ps-3 b-l @endrtl">
                        <p class="bold text-primary my-0">Powered with multiple starter apps</p>
                        <p class="my-0 text-secondary">It's awesome you to have a nice feature to show up</p>

                        <hr class="my-3">
                        <nav id="sw-nav-1" class="nav nav-tabs tabs-clean border-bottom-0">
                            <a href="javascript:;"
                                class="nav-item nav-link @rtl pe-md-0 @else ps-md-0 @endrtl py-0 d-flex flex-column align-items-center border-bottom-0 active"
                                data-step="1">
                                <i data-feather="mail" class="icon"></i>
                                <span class="d-none small">Inbox</span>
                            </a>
                            <a href="javascript:;"
                                class="nav-item nav-link py-0 d-flex flex-column align-items-center border-bottom-0"
                                data-step="2">
                                <i data-feather="calendar" class="icon"></i>
                                <span class="d-none small">Calendar</span>
                            </a>
                            <a href="javascript:;"
                                class="nav-item nav-link py-0 d-flex flex-column align-items-center border-bottom-0"
                                data-step="3">
                                <i data-feather="file" class="icon"></i>
                                <span class="d-none small">Invoice</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 @rtl me-md-auto text-md-end @else ms-md-auto text-md-start @endrtl text-center">
            <div class="mb-5">
                <span class="badge bg-info text-contrast rounded-pill shadow-box bold py-2 px-4">Simple and transparent</span>
                <h2 class="mt-3">Bring your application to life</h2>
                <p class="lead text-secondary">
                    {{ appName() }} includes an outstanding starter Admin Dashboard. You can start developing right away your web application.</p>
            </div>

            <div class="swiper-container" data-sw-navigation="#sw-nav-1" data-sw-navigation-active="active">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <figure class="shadow-box">
                            <img src="{{ asset("img/screens/dash/inbox.png") }}" alt="" class="img-responsive rounded">
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure class="shadow-box">
                            <img src="{{ asset("img/screens/dash/calendar.png") }}" alt="" class="img-responsive rounded">
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure class="shadow-box">
                            <img src="{{ asset("img/screens/dash/invoice.png") }}" alt="" class="img-responsive rounded">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
