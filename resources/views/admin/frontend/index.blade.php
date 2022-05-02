@extends('layouts.app')


@section('content')


    <form class="form" action="{{ route('admin.frontend.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-warning">Heading Section</h5>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                        <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                        <li><a data-action="close"><i class="bi bi-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body">
                    <div class="row">
                        <?php $i=0 ?>
                        @foreach($heading_section as $heading)
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label text-info" for="heading[]">{{ $heading_titler[$i] }}</label>
                                <input type="text" class="form-control" id="heading[]" name="heading[]"
                                    value="{{ $heading }}" />
                            </div>
                        </div>
                        <?php if($i == 7){break;} $i++;  ?>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label class="form-label text-info" for="bgimage">Background Image (.png)</label>
                                <input type="file" name="bgimage" class="form-control">
                            </div>
                            <img class="img-fluid img-thumbnail w-50 rounded mx-auto d-block"
                                src="{{ asset("img/home/".$frontend_images->img1) }}">
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label class="form-label text-info" for="personimage">Person Image (.png)</label>
                                <input type="file" name="personimage" class="form-control">
                            </div>
                            <img class="img-fluid img-thumbnail w-50 rounded mx-auto d-block"
                                src="{{ asset("img/home/".$frontend_images->img2) }}">
                        </div>
                    </div>
                    <div class="card-footer mt-1 pb-0">
                        <div class="col-sm-9 offset-sm-3 text-end">
                            <button type="submit" class="btn btn-primary me-1">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Card Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($card_section as $card)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="card[]">{{ $card_titler[$i] }}</label>
                        <input type="text" class="form-control" id="card[]" name="card[]" value="{{ $card }}" />
                    </div>
                </div>
                <?php if($i == 5){break;} $i++;  ?>
                @endforeach
            </div>
            <div class="card-footer mt-1 pb-0">
                <div class="col-sm-9 offset-sm-3 text-end">
                    <button type="submit" class="btn btn-primary me-1">Update</button>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Gifts Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($gifts_section as $gifts)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="gifts[]">{{ $gifts_titler[$i] }}</label>
                        <input type="text" class="form-control" id="gifts[]" name="gifts[]" value="{{ $gifts }}" />
                    </div>
                </div>
                <?php  if($i == 8){break;} $i++; ?>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-1">
                        <label class="form-label text-info" for="giftimage">Gift Image (.png)</label>
                        <input type="file" name="giftimage" class="form-control">
                    </div>
                    <img class="img-fluid img-thumbnail w-50 rounded mx-auto d-block"
                        src="{{ asset("img/home/".$frontend_images->img3) }}">
                </div>
            </div>
            <div class="card-footer mt-1 pb-0">
                <div class="col-sm-9 offset-sm-3 text-end">
                    <button type="submit" class="btn btn-primary me-1">Update</button>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Security Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($security_section as $security)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="security[]">{{ $security_titler[$i] }}</label>
                        <input type="text" class="form-control" id="security[]" name="security[]"
                            value="{{ $security }}" />
                    </div>
                </div>
                <?php if($i == 8){break;} $i++; ?>
                @endforeach
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label class="form-label text-info" for="secureimage">Secure Image (.svg)</label>
                                <input type="file" name="secureimage" class="form-control">
                            </div>
                            <img class="img-fluid img-thumbnail w-50 rounded mx-auto d-block"
                                src="{{ asset("img/home/".$frontend_images->img4) }}">
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label class="form-label text-info" for="securityimage">Security Image (.png)</label>
                                <input type="file" name="securityimage" class="form-control">
                            </div>
                            <img class="img-fluid img-thumbnail w-50 rounded mx-auto d-block"
                                src="{{ asset("img/home/".$frontend_images->img5) }}">
                        </div>
                    </div>
                    <div class="card-footer mt-1 pb-0">
                        <div class="col-sm-9 offset-sm-3 text-end">
                            <button type="submit" class="btn btn-primary me-1">Update</button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Wallets Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($wallets_section as $wallets)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="wallets[]">{{ $wallets_titler[$i] }}</label>
                        <input type="text" class="form-control" id="wallets[]" name="wallets[]"
                            value="{{ $wallets }}" />
                    </div>
                </div>
                <?php if($i == 7){break;} $i++; ?>
                @endforeach

            </div>
            <div class="card-footer mt-1 pb-0">
                <div class="col-sm-9 offset-sm-3 text-end">
                    <button type="submit" class="btn btn-primary me-1">Update</button>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Features Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($features_section as $features)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="features[]">{{ $features_titler[$i] }}</label>
                        <input type="text" class="form-control" id="features[]" name="features[]"
                            value="{{ $features }}" />
                    </div>
                </div>
                <?php if($i == 2){break;} $i++;  ?>
                @endforeach
            </div>
            <div class="card-footer mt-1 pb-0">

                <div class="col-sm-9 offset-sm-3 text-end">
                    <button type="submit" class="btn btn-primary me-1">Update</button>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Partners Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($partners_section as $partners)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="partners[]">{{ $partners_titler[$i] }}</label>
                        <input type="text" class="form-control" id="partners[]" name="partners[]"
                            value="{{ $partners }}" />
                    </div>
                </div>
                <?php if($i == 2){break;} $i++; ?>
                @endforeach
            </div>
            <div class="card-footer mt-1 pb-0">

                <div class="col-sm-9 offset-sm-3 text-end">
                    <button type="submit" class="btn btn-primary me-1">Update</button>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Testimonials Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($testimonials_section as $testimonials)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="testimonials[]">{{ $testimonials_titler[$i] }}</label>
                        <input type="text" class="form-control" id="testimonials[]" name="testimonials[]"
                            value="{{ $testimonials }}" />
                    </div>
                </div>
                <?php  if($i == 2){break;}$i++; ?>
                @endforeach
            </div>
            <div class="card-footer mt-1 pb-0">

                <div class="col-sm-9 offset-sm-3 text-end">
                    <button type="submit" class="btn btn-primary me-1">Update</button>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Try Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($try_section as $try)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="try[]">{{ $try_titler[$i] }}</label>
                        <input type="text" class="form-control" id="try[]" name="try[]" value="{{ $try }}" />
                    </div>
                </div>
                <?php  if($i == 4){break;}$i++; ?>
                @endforeach
            </div>
            <div class="card-footer mt-1 pb-0">

                <div class="col-sm-9 offset-sm-3 text-end">
                    <button type="submit" class="btn btn-primary me-1">Update</button>

                </div>
            </div>

        </div>

    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title text-warning">Footer Section</h5>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="bi bi-chevron-down"></i></a></li>
                <li><a data-action="reload"><i class="bi bi-arrow-repeat"></i></a></li>
                <li><a data-action="close"><i class="bi bi-x"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-content collapse show" aria-expanded="true">
        <div class="card-body">

            <div class="row">
                @foreach($footer_section as $footer)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="mb-1">
                        <label class="form-label text-info" for="footer[]">{{ $footer_titler[$i] }}</label>
                        <input type="text" class="form-control" id="footer[]" name="footer[]" value="{{ $footer }}" />
                    </div>
                </div>
                <?php  if($i == 4){break;}$i++; ?>
                @endforeach
            </div>
            <div class="card-footer mt-1 pb-0">

                <div class="col-sm-9 offset-sm-3 text-end">
                    <button type="submit" class="btn btn-primary me-1">Update</button>

                </div>
            </div>

        </div>

    </div>
</div>

</form>

@endsection

@section('vendor-script')


@endsection
@push('script')

    <script>

    </script>

@endpush
