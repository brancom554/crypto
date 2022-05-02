<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Inline text elements</h2>
        <p class="lead italic">Styling for common inline HTML5 elements.</p>
    </div>

    <table class="table table-borderless">
        <thead>
        <tr>
            <th>Element</th>
            <th>Example</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($elements as $element)
            <tr>
                <td>
                    <code>&lt;{{ $element['tag'] }}&gt;&lt;/{{ $element['tag'] }}&gt;</code>
                    @if (isset($element['class']))
                    or <code>.{{ $element['class'] }}</code>
                    @endif
                </td>
                <td><{{ $element['tag'] }} @if (isset($element['class'])) class="{{ $element['class'] }}" @endif>
                    {!! $element['text'] !!}.
                    </{{ $element['tag'] }}>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-utils.container>
