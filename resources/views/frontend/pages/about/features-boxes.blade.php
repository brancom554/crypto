<!-- ./Features - Boxed -->
<x-utils.container class="features bg-darker" container-class="bring-to-front">
    <div class="section-heading text-center">
        <h2 class="bold text-contrast">Our features stack</h2>
        <p class="lead text-muted">Take the control of your web with DashCore. You can customize the theme
            according to your needs or just use the ready-to-use content we made for you</p>
    </div>
    @php ($features = [
        [ "icon" => "phone", "title" => "Responsive" ],
        [ "icon" => "settings", "title" => "Customizable" ],
        [ "icon" => "award", "title" => "Clean Code" ],
        [ "icon" => "star", "title" => "Creative" ],
        [ "icon" => "send", "title" => "Ready-Content" ],
        [ "icon" => "headphones", "title" => "Supported" ],
        [ "icon" => "hard-drive", "title" => "Documented" ],
        [ "icon" => "box", "title" => "Components" ]
    ])
    <div class="row g-4">
        @foreach ($features as $feature)
        <div class="col-6 col-md-3">
            <div class="shadow-box shadow-hover lift-hover border-0 card bg-dark text-contrast">
                <div class="card-body text-center">
                    <i data-feather="{{ $feature['icon'] }}" class="stroke-primary" width="36" height="36"></i>
                    <p class="mb-0">{{ $feature['title'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-utils.container>
