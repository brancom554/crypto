<!-- ./Team -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="row gap-y">
            @foreach ( $team as $member )
            @if ($member['onStatic'])
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <figure class="shadow rounded-circle p-6 mb-4 icon-xxl image-background cover center-top"
                                style="background-image: url({{ asset("img/avatar/team/" . ($loop->index + 1) . ".jpg") }})"></figure>
                        <h6 class="bold font-l">{{ $member['name'] }}</h6>
                        <p class="small mt-0 text-primary text-uppercase">{{ $member['position'] }}</p>

                        <p class="text-center italic">{{ $member['quote'] }}</p>
                        <hr class="w-50">
                        <nav class="nav">
                            @foreach ( $member['social'] as $net )
                            <a href="javascript:;" class="nav-item nav-link pb-0">
                                <i class="fab fa-{{ $net }} text-secondary"></i>
                            </a>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
</x-utils.container>
