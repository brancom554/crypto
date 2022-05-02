<!-- ./CTA - Start Now -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="shadow rounded text-center bg-dark p-5">
            <div class="text-contrast">
                <i class="fa fa-heart fa-2x mb-3"></i>
                <h2 class="mb-5 text-contrast">@Lang('Try Dashcore now... Love it forever!')</h2>
                <p class="handwritten highlight font-md">@Lang('Why wait? Start now!')</p>
            </div>

            <x-utils.link :href="route('frontend.auth.register')"
                          class="btn btn-success text-contrast btn-rounded mt-4"
                          text="Buy DashCore on Themeforest" />
        </div>
</x-utils.container>
