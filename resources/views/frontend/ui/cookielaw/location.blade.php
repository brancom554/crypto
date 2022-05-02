<!-- ./CookieLaw - Informational -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Location</h2>
        <p class="lead italic">If you want, cookie-law can automatically adapt to the user's location. Choose a country and see how the law and banner changes:</p>
    </div>

    <div class="row text-center">
        <div class="col-md-6 mx-md-auto">
            <div class="form-controls form-group">
                <label>Country</label>
                <select id="cookie-law-location" class="form-select selectbox"></select>
            </div>

            <div id="message" class="cookie-location-message"></div>
        </div>
    </div>
</x-utils.container>
