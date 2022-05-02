<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Headings</h2>
        <p class="lead italic">All HTML headings, <code>&lt;h1&gt;</code> through <code>&lt;h6&gt;</code>, are available.</p>
    </div>

    <table class="table table-borderless">
        <thead>
            <tr>
                <th>Heading</th>
                <th>Example</th>
            </tr>
        </thead>
        <tbody>
        @for ($i = 1; $i < 7; $i++)
            <tr>
                <td><code>&lt;h{{ $i }}&gt;&lt;/h{{ $i }}&gt;</code></td>
                <td><span class="h{{ $i }}">h{{ $i }}. Bootstrap heading</span></td>
            </tr>
        @endfor
        </tbody>
    </table>
</x-utils.container>
