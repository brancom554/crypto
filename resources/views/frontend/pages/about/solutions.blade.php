<!-- ./Dashboard Included top-{{ "right RTL else left" }} -->
<x-utils.container class="bg-light edge top-left" container-class="bring-to-front">
    <div class="section-heading text-center">
        <h2 class="bold">A solution for every need</h2>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aperiam atque dicta
            dignissimos eius excepturi fuga laudantium libero nam nihil, obcaecati pariatur quaerat quam, quia
            quisquam repudiandae sed tenetur veniam!</p>
    </div>

    <div class="row align-items-center gap-y">
        <div class="col-md-6 col-lg-5">
            @php ($features = [
                [ "icon" => "box", "title" => "Full Code", "description" => "DashCore comes with fully documented HTML, SASS, JS, PHP code, all in a well organized and structured way." ],
                [ "icon" => "settings", "title" => "Free Updates", "description" => "You'll get lifetime free updates as we improve or add new features." ],
                [ "icon" => "award", "title" => "Premium Support", "description" => "In case you need it, We got you covered, with our premium quality fast support service." ]
            ])

            <ul class="list-unstyled">
                @foreach ($features as $feature)
                <li class="d-flex flex-column align-items-center align-items-md-start">
                    <span>
                        <i data-feather="{{ $feature['icon'] }}" width="36" height="36" stroke-width="1" class="stroke-primary @rtl ms-3 @else me-3 @endrtl"></i>
                    </span>

                    <div class="mt-3 mt-lg-0 text-center @rtl text-md-end @else text-md-start @endrtl">
                        <h5 class="bold text-dark">{{ $feature['title'] }}</h5>
                        <p class="mt-0{{ $loop->index < count($features) ? " mb-5" : "" }}">{{ $feature['description'] }}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6 col-lg-5 ms-md-auto">
            <div class="shadow card">
                <div class="card-header overlay gradient gradient-blue-purple alpha-5 image-background cover"
                    style="background-image: url({{ asset("img/screens/dash/4.png") }})">
                    <div class="content">
                        <h2 class="mt-10 text-contrast">Dashboard Included</h2>
                    </div>
                </div>

                <div class="card-body p-4">
                    <p>Our template is packed with a <span class="bold">Starter Admin Dashboard</span> to help you
                        get started right away with your project. You'll have a beautiful HTML template to
                        promote your product plus a starting point Admin Template</p>

                    <a href="javascript;" class="btn btn-primary btn-rounded mt-4">Try the Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
