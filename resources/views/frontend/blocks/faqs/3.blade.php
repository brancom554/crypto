<!-- ./FAQs -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="text-capitalize">frequently <span class="bold">asked questions</span></h2>
            <p class="lead text-secondary">@Lang('Here are the answers to some of the most common questions we hear from our appreciated customers')</p>
        </div>

        <div class="row gap-y">
            @foreach ($faqs as $faq)
            <div class="col-md-6">
                <h5 class="bold">{{ $faq['question'] }}</h5>
                <p>{{ $faq['answer'] }}</p>
            </div>
            @endforeach
        </div>
</x-utils.container>
