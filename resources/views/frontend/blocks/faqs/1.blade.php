<!-- ./FAQs -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="row">
            <div class="col-md-4">
                <h2>@Lang('Do you have') <span class="bold">@Lang('questions?')</span></h2>
                <p class="lead">@Lang('Not sure how this template can help you? Wonder why you need to buy our theme?')</p>
                <p class="text-muted">@Lang('Here are the answers to some of the most common questions we hear from our appreciated customers')</p>
            </div>

            <div class="col-md-8">
                @include("frontend.blocks.faqs.accordion", ["faqs" => $faqs])
            </div>
        </div>
</x-utils.container>
