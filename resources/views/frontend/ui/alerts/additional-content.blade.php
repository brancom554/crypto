<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Additional content</h2>
        <p class="lead italic">Alerts can also contain additional HTML elements like headings, paragraphs and dividers.</p>
    </div>

    <div class="row gap-y">
        <div class="col-md-8 mx-auto">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>
        </div>
    </div>
</x-utils.container>
