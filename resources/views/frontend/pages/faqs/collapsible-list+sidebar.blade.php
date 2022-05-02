<!-- ./FAQs -->
<x-utils.container class="bg-light">
    <div class="row g-4">
        <div class="col-lg-8 order-lg-2 @rtl b-md-r @else b-md-l @endrtl">
            <h3 class="bold">Common Questions</h3>
            <hr class="mb-4">

            @include("frontend.blocks.faqs.accordion", ["faqs" => $faqs])
        </div>

        <div class="col-lg-4">
            <h5 class="bold small text-uppercase mb-3">@Lang('search')</h5>
            <form class="form search-box">
                <div class="input-group">
                    <input type="email" name="Search[q]" class="form-control @rtl rounded-circle-right @else rounded-circle-left @endrtl" placeholder="Search form..." required>

                    <button class="btn btn-contrast @rtl rounded-circle-left border-end-0 me-n1 @else rounded-circle-right border-start-0 @endrtl" type="submit" data-loading-text="Searching ...">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <h4 class="bold small text-uppercase mt-4 mb-3">categories</h4>
            <nav class="nav flex-column font-sm">
                <x-utils.link class="ps-0 nav-item nav-link bold active" :text="__('Common Questions')" />
                <x-utils.link class="ps-0 nav-item nav-link" :text="__('Getting Started')" />
                <x-utils.link class="ps-0 nav-item nav-link" :text="__('My Account')" />
                <x-utils.link class="ps-0 nav-item nav-link" :text="__('Integrations')" />
                <x-utils.link class="ps-0 nav-item nav-link" :text="__('Licencing')" />
            </nav>
        </div>
    </div>
</x-utils.container>
