<!-- ./Overview - Floating boxes -->
<x-utils.container class="overview">
    <div class="row align-items-center gap-y">
        <div class="col-lg-6 text-center @rtl text-md-end @else text-md-start @endrtl">
            <div class="section-heading">
                <span class="badge bg-contrast text-primary shadow-sm px-4 py-2 rounded-pill bold mb-2">
                    Succeed with DashCore
                </span>
                <h2>The new way to <br><span class="bold">showcase your Startup</span></h2>

                <p class="lead text-secondary">
                    {{ appName() }} is a Bootstrap 5 HTML template. Designed to help you promote your solution in an easy and beautiful way.
                </p>
            </div>

            <p>
                It includes multiple components and pre-made demos ready for you to personalize it according to your own
                needs. {{ appName() }} includes a ready-to-go Admin Dashboard with many out-of-the-box features.
            </p>
        </div>

        <div class="col-lg-6">
            <div class="row gap-y">
                @php ($cards = [
                    [ "icon" => [ "name" => "calendar", "class" => "stroke-primary" ], "title" => "Calendar", "description" => [ "text" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi at, cumque dolores dolorum est." ], "class" => "mt-6 ms-lg-auto", "bg" => "", "animation" => "fade-up" ],
                    [ "icon" => [ "name" => "bar-chart", "class" => "" ], "title" => "Dashboard", "description" => [ "color" => "contrast", "text" => "Cupiditate debitis delectus dolor dolore doloremque, doloribus eveniet illo in labore neque." ], "class" => "me-lg-auto", "bg" => "text-contrast bg-info-gradient", "animation" => "fade-up" ],
                    [ "icon" => [ "name" => "mail", "class" => "stroke-primary" ], "title" => "Inbox", "description" => [ "text" => "Amet aperiam cumque delectus eligendi, esse, modi nemo nisi officiis rem repellat sed ulla." ], "class" => "ms-lg-auto", "bg" => "", "animation" => "fade-up" ],
                    [ "icon" => [ "name" => "clipboard", "class" => "stroke-primary" ], "title" => "Invoicing", "description" => [ "text" => "Ad aliquam dicta, eaque eos iusto totam velit. Amet atque dolorum eaque ipsa sed. Aliquid cupiditate." ], "class" => "mt-n6 me-lg-auto", "bg" => "", "animation" => "fade-up" ]
                ])

                @foreach ($cards as $card)
                <div class="col-6 col-sm-5 col-md-6 {{ $card['class'] }}">
                    <div data-aos="{{ $card['animation'] }}">
                        <div class="{{ $card['bg'] }} card rounded p-2 p-sm-4 shadow-hover text-center @rtl text-md-end @else text-md-start @endrtl">
                            <i data-feather="{{ $card['icon']['name'] }}" width="36" height="36" class="{{ $card['icon']['class'] }}"></i>
                            <p class="bold mb-0">{{ $card['title'] }}</p>
                            <p class="small text-{{ isset($card['description']['color']) ? $card['description']['color'] : "muted" }}">{{ $card['description']['text'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-utils.container>
