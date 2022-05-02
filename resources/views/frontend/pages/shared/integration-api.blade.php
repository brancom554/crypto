<!-- ./Integration API -->
@php ($blocks = [
    [ "title" => "Engagement API", "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consequuntur.", "navigation" => "javascript:;" ],
    [ "title" => "Invoicing API", "description" => "Consequuntur fugit minima natus optio quisquam sint sunt? Earum harum in laudantium nobis obcaecati odio.", "navigation" => "javascript:;" ],
    [ "title" => "Reporting API", "description" => "Earum harum in laudantium nobis obcaecati odio, praesentium, quis sequi soluta vel veniam.", "navigation" => "javascript:;" ]
])
<x-utils.container class="mt-n6" container-class="pt-0">
    <div class="row g-3 text-center @rtl text-md-end @else text-md-start @endrtl">

        @foreach ($blocks as $block)
        <div class="col-md-4">
            <div class="card shadow-sm shadow-hover lift-hover h-100">
                <div class="card-body bg-contrast p-4">
                    <a href="{{ $block['navigation'] }}" class="text-darker">
                        <h4 class="bold @rtl ms @else me-3 @endrtl">{{ $block['title'] }}</h4>
                    </a>

                    <p class="mt-4">{{ $block['description'] }}</p>

                    <a href="{{ $block['navigation'] }}" class="d-block d-md-flex align-items-center mt-auto">
                        Learn more <i class="fas fa-long-arrow-alt-right @rtl me @else ms-3 @endrtl"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-utils.container>
