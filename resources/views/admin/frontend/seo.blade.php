@extends('layouts.app')
@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.seo.content', 'seo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="data">
                        <input type="hidden" name="seo_image" value="1">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="col">
                                    <div class="image-upload">
                                        <div class="thumb mt-2">
                                            <div class="mb-2">
                                                <div class="profilePicPreview" style="height:300px;background-image: url({{getImage(imagePath()['seo']['path'].'/'. @$seo->data_values->image,imagePath()['seo']['size']) }})">
                                                    <button type="button" class="btn btn-icon btn-danger btn-sm"><i class="bi bi-x"></i></button>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" type="file" name="image_input" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="input-group-text">{{ __('locale.Upload Image')}}</label>
                                            </div>
                                                <small class="mt-2 text-facebook">{{ __('locale.Supported files')}}: <b>{{ __('locale.jpeg')}}, {{ __('locale.jpg')}}</b>. {{ __('locale.Image will be resized into')}} {{imagePath()['seo']['size']}}{{ __('locale.px')}}. </small>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8 mt-xl-0 mt-4">
                                <div class="col ">
                                    <label class="form-control-label h6 mt-1">{{ __('locale.Meta Keywords')}}</label>
                                    <small class="ml-2 mt-2 text-facebook">{{ __('locale.Separate multiple keywords by')}} <code>,</code>({{ __('locale.comma')}}) {{ __('locale.or')}} <code>{{ __('locale.enter')}}</code> {{ __('locale.key')}}</small>
                                    <select name="keywords[]" class="select2 form-select" id="select2-basic"  multiple="multiple" required>
                                        @if(@$seo->data_values->keywords)
                                            @foreach($seo->data_values->keywords as $option)
                                                <option value="{{ $option }}" selected>{{ __($option) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="form-control-label  h6 mt-1">{{ __('locale.Meta Description')}}</label>
                                    <textarea name="description" rows="3" class="form-control" placeholder="{{ __('locale.SEO meta description')}}" required>{{ @$seo->data_values->description }}</textarea>
                                </div>
                                <div class="col">
                                    <label class="form-control-label  h6 mt-1">{{ __('locale.Social Title')}}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('locale.Social Share Title')}}" name="social_title" value="{{ @$seo->data_values->social_title }}" required/>
                                </div>
                                <div class="col">
                                    <label class="form-control-label  h6 mt-1">{{ __('locale.Social Description')}}</label>
                                    <textarea name="social_description" rows="3" class="form-control" placeholder="{{ __('locale.Social Share  meta description')}}" required>{{ @$seo->data_values->social_description }}</textarea>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-success mt-2">{{ __('locale.Update')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page-script')
<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
