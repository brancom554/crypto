<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Responsive tables</h2>
        <p class="lead italic">Responsive tables allow tables to be ease-readable on mobiles. Make any table responsive across all viewports by wrapping a <code>.table</code> with <code>.table-responsive</code>.</p>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Heading</th>
                <th scope="col">Heading</th>
                <th scope="col">Heading</th>
                <th scope="col">Heading</th>
                <th scope="col">Heading</th>
                <th scope="col">Heading</th>
                <th scope="col">Heading</th>
                <th scope="col">Heading</th>
                <th scope="col">Heading</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
                <td data-title="Heading">Cell</td>
            </tr>
            </tbody>
        </table>
    </div>
</x-utils.container>
