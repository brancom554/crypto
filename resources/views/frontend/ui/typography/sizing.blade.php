<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Sizing</h2>
        <p class="lead italic">Easily change the size of your text with sizing classes.</p>
    </div>

    <table class="table table-borderless">
        <thead>
            <tr>
                <th>Heading</th>
                <th>Example</th>
            </tr>
        </thead>
        <tbody>
        @foreach ( $sizing as $size )
            <tr>
                <td><code>.font-{{ $size }}</code></td>
                <td><span class="text-dark font-{{ $size }}">Text size variation.</span></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-utils.container>
