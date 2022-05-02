<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Sizes</h2>
        <p class="lead italic">Fancy larger or smaller buttons? Add <code>.btn-xs</code>, <code>.btn-sm</code>,
            <code>.btn-md</code>, <code>.btn-lg</code> or <code>.btn-xl</code> for additional sizes.</p>
    </div>

    <p class="b-b pb-2 mb-5 text-primary bold small">Solid</p>
    <div class="d-flex flex-wrap justify-content-around align-items-center">
        @foreach ( $buttons['sizes'] as $size )
        <button type="button" class="btn btn-{{ $size }} btn-primary">btn-{{ $size }}</button>
        @endforeach
    </div>

    <p class="b-b pb-2 mb-5 text-primary bold small">Outline</p>
    <div class="d-flex flex-wrap justify-content-around align-items-center">
        @foreach ( $buttons['sizes'] as $size )
        <button type="button" class="btn btn-{{ $size }} btn-outline-primary">btn-{{ $size }}</button>
        @endforeach
    </div>

    <p class="b-b pb-2 mb-5 text-primary bold small">Rounded</p>
    <div class="d-flex flex-wrap justify-content-around align-items-center">
        @foreach ( $buttons['sizes'] as $size )
        <button type="button" class="btn btn-rounded btn-{{ $size }} btn-primary">btn-{{ $size }}</button>
        @endforeach
    </div>

    <p class="b-b pb-2 mb-5 text-primary bold small">Circle</p>
    <div class="d-flex flex-wrap justify-content-around align-items-center">
        @foreach ( $buttons['sizes'] as $size )
        <button type="button" class="btn btn-circle btn-{{ $size }} btn-outline-primary"><i
                class="far fa-comments"></i></button>
        @endforeach
    </div>
</x-utils.container>
