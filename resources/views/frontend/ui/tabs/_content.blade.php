<nav class="nav {{ $class ?? '' }} mb-4" id="tab-{{ $id }}">
    <a class="nav-item nav-link active" id="home-{{ $id }}-tab" data-bs-toggle="tab" href="#home-{{ $id }}">Home</a>
    <a class="nav-item nav-link" id="profile-{{ $id }}-tab" data-bs-toggle="tab" href="#profile-{{ $id }}">Profile</a>
    <a class="nav-item nav-link" id="contact-{{ $id }}-tab" data-bs-toggle="tab" href="#contact-{{ $id }}">Contact</a>
    <a class="nav-item nav-link disabled" href="javascript:;">Disabled</a>
</nav>

<div class="tab-content" id="tab-default-content-{{ $id }}">
    <div class="tab-pane fade show active" id="home-{{ $id }}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores commodi consectetur debitis deleniti distinctio dolor et exercitationem fugit illum, impedit inventore ipsum laudantium magni placeat porro qui quisquam veritatis?</div>
    <div class="tab-pane fade" id="profile-{{ $id }}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim minima nulla vero? Ad assumenda blanditiis consequatur cumque eius harum, impedit incidunt ipsum iure natus neque nisi repellat velit vero voluptatum.</div>
    <div class="tab-pane fade" id="contact-{{ $id }}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error illum nisi nostrum quos, ratione suscipit! Accusantium aperiam beatae blanditiis consequatur deserunt dicta dignissimos eligendi enim excepturi, iste maxime repudiandae, tenetur.</div>
</div>
