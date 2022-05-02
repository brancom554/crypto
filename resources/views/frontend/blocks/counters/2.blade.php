<!-- ./Counters -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="row gap-y">
            @php ($counters = [
                [ "icon" => "box", "value" => 273, "title" => "Components" ],
                [ "icon" => "download-cloud", "value" => 654, "title" => "Downloads" ],
                [ "icon" => "settings", "value" => 7941, "title" => "Followers" ],
                [ "icon" => "award", "value" => 654, "title" => "New users"]
            ])
            @foreach ($counters as $counter)
            <div class="col-6 col-md-3">
                <div class="d-flex align-items-center">
                    <i data-feather="{{ $counter['icon'] }}" class="stroke-primary @rtl ms-2 @else me-2 @endrtl" width="36" height="36"></i>
                    <span class="counter bold text-darker font-md">{{ $counter['value'] }}</span>
                </div>
                <p class="text-secondary m-0">{{ $counter['title'] }}</p>
            </div>
            @endforeach
        </div>
</x-utils.container>
