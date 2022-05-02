<x-utils.container class="form-basic {{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Clean</h2>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p class="b-b pb-2 mb-5 bold text-dark">Text</p>
            @include ("frontend.ui.tabs._content", [ "id" => "clean", "class" => "nav-tabs tabs-clean" ])
        </div>

        <div class="col-md-6">
            <p class="b-b pb-2 mb-5 bold text-dark">Icon + <span class="text-danger">Slide Effect</span></p>
            <nav class="nav nav-tabs nav-fill tabs-clean slide mb-4">
                <a class="nav-item nav-link active" data-bs-toggle="tab" href="#clean-icon-profile">
                    <i class="far fa-id-card icon"></i>
                </a>
                <a class="nav-item nav-link" data-bs-toggle="tab" href="#clean-icon-todo">
                    <i class="fas fa-list-ul icon"></i>
                </a>
                <a class="nav-item nav-link" data-bs-toggle="tab" href="#clean-icon-users">
                    <i class="fas fa-users icon"></i>
                </a>
                <a class="nav-item nav-link" data-bs-toggle="tab" href="#clean-icon-settings">
                    <i class="fas fa-cog icon"></i>
                </a>
            </nav>

            <div class="tab-content">
                <div class="tab-pane active" id="clean-icon-profile">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque eligendi impedit pariatur
                    tempore! A, adipisci animi dolor impedit inventore iure laboriosam laborum maiores modi nesciunt
                    nulla repellendus tenetur veritatis voluptas.
                </div>
                <div class="tab-pane" id="clean-icon-todo">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem dolores dolorum ex, fugit
                    repellat vero voluptates. Accusantium beatae debitis fugiat non praesentium quo! Adipisci
                    eligendi exercitationem natus necessitatibus possimus quibusdam.
                </div>
                <div class="tab-pane" id="clean-icon-users">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias consequatur dolores libero nemo
                    nesciunt quam sapiente? Assumenda blanditiis debitis exercitationem, expedita impedit ipsa neque
                    praesentium quae quo sequi totam unde?
                </div>
                <div class="tab-pane" id="clean-icon-settings">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus minus quod quos ratione rem
                    similique. Ab dicta dignissimos expedita illo inventore iste minima modi neque possimus
                    reprehenderit sequi, ullam voluptatem.
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
