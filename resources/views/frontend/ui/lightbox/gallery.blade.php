<!-- ./Lightbox - Gallery -->
<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Lightbox gallery</h2>
        <p class="lead italic">You may put any HTML content in each gallery item and mix content types. In this example lazy-loading of images is enabled for the next image based on move direction.</p>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto text-center">
            <div class="modal-popup popup-gallery grid-of-images" data-type="gallery" data-image='{"verticalFit": true}' data-zoom="300">
                @php ($images = [
                    [ "title" => "Some nice title to show", "image" => 997 ],
                    [ "title" => "Some nice title to show", "image" => 977 ],
                    [ "title" => "Some nice title to show", "image" => 976 ],
                    [ "title" => "Some nice title to show", "image" => 1074 ],
                    [ "title" => "Some nice title to show", "image" => 874 ],
                    [ "title" => "Some nice title to show", "image" => 937 ],
                    [ "title" => "Some nice title to show", "image" => 107 ]
                ])
                @foreach ($images as $i)
                    <a href="https://picsum.photos/800/600/?image={{ $i['image'] }}" title="{{ $i['title'] }}">
                        <img src="https://picsum.photos/75/75/?image={{ $i['image'] }}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-utils.container>
