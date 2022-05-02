<!-- ./Counters -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="row align-items-center text-center @rtl text-lg-right @else text-lg-left @endrtl">
            <div class="col-12 col-md-7 col-lg-6 @rtl ms-lg-auto @else me-lg-auto @endrtl text-center @rtl text-md-end @else text-md-start @endrtl">
                <i data-feather="activity" width="36" height="36" class="stroke-primary"></i>
                <p class="small text-primary bold">Amazing stats</p>
                <h2 class="bold">Get the very best of us by doing the best of you</h2>
                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis dolores dolorum,
                    error est excepturi exercitationem hic iusto minus nam officia optio quasi tempore voluptatibus. Aut
                    dolore in nostrum quae voluptatem!</p>
            </div>

            <div class="col-12 col-md-5 col-lg-6 col-xl-5">
                <div class="row g-3">
                    @php ($boxes = [
                        [ "value" => "954", "valueCss" => "text-dark", "text" => "Users", "bg" => "bg-contrast", "icon" => "user", "iconClass" => "stroke-secondary" ],
                        [ "value" => "37", "valueCss" => "text-dark", "text" => "Downloads", "bg" => "bg-contrast", "icon" => "download-cloud", "iconClass" => "stroke-secondary" ],
                        [ "value" => "19", "valueCss" => "text-dark", "text" => "Plugins", "bg" => "bg-contrast", "icon" => "box", "iconClass" => "stroke-secondary" ],
                        [ "value" => "31", "valueCss" => "", "text" => "Projects", "bg" => "bg-primary text-contrast", "icon" => "star", "iconClass" => "stroke-contrast" ]
                    ])
                    @foreach ($boxes as $box)
                    <div class="col-6">
                        <div class="rounded border shadow-box shadow-hover p-2 p-sm-3 d-flex align-items-center flex-wrap {{ $box['bg'] }}">
                            <i data-feather="{{ $box['icon'] }}" width="36" height="36" class="@rtl ms-4 @else me-4 @endrtl {{ $box['iconClass'] }}"></i>

                            <div class="@rtl text-end @else text-start @endrtl">
                                <p class="counter font-md bold m-0 {{ $box['valueCss'] }}">{{ $box['value'] }}</p>
                                <p class="m-0">{{ $box['text'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-utils.container>
