<!-- Features -->
<x-utils.container>
    <div class="section-heading">
        <h2 class="heading-line">{{ $features_section['0'] }}</h2>
    </div>

    <div class="row gap-y text-center @rtl text-md-end @else text-md-start @endrtl">
        @php($features = [
            [ "icon" => 'pie-chart', "title" => 'Dashboard' ],
            [ "icon" => 'dollar-sign', "title" => 'Save money' ],
            [ "icon" => 'sliders', "title" => 'Design tools' ],
            [ "icon" => 'download', "title" => 'Updates' ],
            [ "icon" => 'pie-chart', "title" => 'Dashboard' ],
            [ "icon" => 'dollar-sign', "title" => 'Save money' ]
        ])
        @foreach ($features as $f)
            <div class="col-md-4">
                <div class="icon-anime mb-3">
                    <i data-feather="{{ $f['icon'] }}" width="36" height="36" class="icon stroke-darker"></i>
                    <div class="shape bg-alternate-gradient circle" data-aos="fade-up" data-aos-delay="100" data-aos-offset="0"></div>
                </div>

                <p class="my-0 bold lead text-dark">{{ $f['title'] }}</p>
                <p>{{ $features_section['1'] }}</p>
            </div>
        @endforeach
    </div>
</x-utils.container>
