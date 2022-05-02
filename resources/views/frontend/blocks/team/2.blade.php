<!-- ./Team -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="row gap-y">
        @foreach ($team as $member)
        @if ($member['onStatic'])
        <div class="col-md-6 col-lg-3 d-flex flex-column align-items-center">
            <a href="javascript:;"><img src="{{ asset("img/avatar/team/" . ($loop->index + 1) . ".jpg") }}" class="img-responsive mb-3 rounded" alt="..."></a>
            <h6 class="bold font-l">{{ $member['name'] }}</h6>
            <p class="small mt-0 text-primary text-uppercase">{{ $member['position'] }}</p>

            <nav class="nav">
                @foreach ($member['social'] as $net)
                <a href="javascript:;" class="nav-item nav-link pb-0">
                    <i class="fab fa-{{ $net }} text-secondary"></i>
                </a>
                @endforeach
            </nav>
        </div>
        @endif
        @endforeach
    </div>
</x-utils.container>
