<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2>Animation</h2>
        <p class="lead">Animated progress bars requires waypoints, and can be configured to be used with any of the previous styles and/or sizes</p>
    </div>

    <div class="row gap-y">
        <div class="col-md-8 mx-auto">
            <div class="animate-bars">
                <ul class="progress-bars horizontal-demo-bars"></ul>
            </div>
        </div>
    </div>
</x-utils.container>
