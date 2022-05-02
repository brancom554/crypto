<!-- ./CTA - Get it Now -->
<x-utils.container
    class="gradient gradient-blue-purple overlay alpha-8 text-contrast text-center {{ $class ?? ''}}" container-class="{{ $containerClass ?? '' }}"
>
    <div class="section-heading">
        <p class="badge badge-outline-contrast bold rounded-pill py-2 px-4">@Lang('Wait no more')...</p>
        <h2 class="text-contrast">Get <span class="bold">DashCore</span> NOW!</h2>
        <p>@Lang("Thinking about boost your website? but, you want a template to fit all you need, just hit the buy button and you're all set")</p>
    </div>

    <p class="handwritten highlight font-md mb-4">Don't wait</p>
    <x-utils.link class="btn btn-contrast btn-rounded" href="https://5studios.net/themes/dashcore">
        Buy it on Themeforest
        <i class="fas fa-long-arrow-alt-right ms-3"></i>
    </x-utils.link>
</x-utils.container>
