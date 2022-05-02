@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.gateway.manual.update', $method->code) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-3">
                                    <img class="img-thumbnail mb-1" src="{{getImage(imagePath()['gateway']['path'].'/'. $method->image,imagePath()['gateway']['path'])}}"/>
                                    <input type="file" name="image" class="form-control" id="image" accept=".png, .jpg, .jpeg"/>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <label class="h6">{{ __('locale.Gateway Name')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="{{ __('locale.Method Name')}}"
                                                name="name" value="{{ $method->name }}" />
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <label class="h6">{{ __('locale.Currency')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="currency" placeholder="{{ __('locale.Currency')}}"
                                                class="form-control rounded"
                                                value="{{ @$method->single_currency->currency }}" />
                                        </div>
                                        <div class="col-xl-5 col-md-12">
                                            <label class="h6">{{ __('locale.Rate')}} <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                                <div class="input-group-text">1 {{ __($general->cur_text) }} =</div>
                                                <input type="text" class="form-control" placeholder="0" name="rate"
                                                    value="{{ getAmount(@$method->single_currency->rate) }}" />
                                                <div class="input-group-text"><span class="currency_symbol"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="card border-primary">
                                                <h5 class="card-header text-white bg-primary">{{ __('locale.Range')}}</h5>
                                                <div class="card-body">
                                                        <label class="mt-1 h6">{{ __('locale.Minimum Amount')}} <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-text">{{ __($general->cur_text) }}</div>
                                                            <input type="text" class="form-control" name="min_limit" placeholder="0" value="{{ old('min_limit') }}"/>
                                                        </div>
                                                        <label class="mt-1 h6">{{ __('locale.Maximum Amount')}} <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-text">{{ __($general->cur_text) }}</div>
                                                            <input type="text" class="form-control" placeholder="0" name="max_limit" value="{{ old('max_limit') }}"/>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="card border-primary">
                                                <h5 class="card-header text-white bg-primary">{{ __('locale.Charge')}}</h5>
                                                <div class="card-body">
                                                        <label class="mt-1 h6">{{ __('locale.Fixed Charge')}} <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-text">{{ __($general->cur_text) }}</div>
                                                            <input type="text" class="form-control" placeholder="0" name="fixed_charge" value="{{ old('fixed_charge') }}"/>
                                                        </div>
                                                        <label class="mt-1 h6">{{ __('locale.Percent Charge')}} <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <div class="input-group-text">%</div>
                                                            <input type="text" class="form-control" placeholder="0" name="percent_charge" value="{{ old('percent_charge') }}">
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-lg-12">
                                        <div class="card border-dark mt-3">

                                            <h5 class="card-header text-white bg-dark">{{ __('locale.Deposit Instruction')}}</h5>
                                            <div class="card-body">
                                                <div class="col">
                                                    <textarea rows="8" class="form-control rounded mt-1" name="instruction">{{ __(@$method->description)  }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border-dark mt-3">
                                            <h5 class="card-header text-white bg-dark  text-white">{{ __('locale.User data')}}
                                                <button type="button" class="btn btn-sm btn-outline-light float-end addUserData"><i class="bi bi-plus"></i>{{ __('locale.Add new')}}
                                                </button>
                                            </h5>

                                            <div class="card-body">
                                                <div class="row addedField">
                                                    @if($method->input_form != null)
                                                        @foreach($method->input_form as $k => $v)
                                                            <div class="col-md-12 user-data">
                                                                <div class="col">
                                                                    <div class="input-group mb-md-0 mb-4">
                                                                        <div class="col-md-4">
                                                                            <input name="field_name[]" class="form-control" type="text" value="{{$v->field_level}}" required placeholder="{{ __('locale.Field Name')}}">
                                                                        </div>
                                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                                            <select name="type[]" class="form-control">
                                                                                <option value="text" @if($v->type == 'text') selected @endif> {{ __('locale.Input Text')}} </option>
                                                                                <option value="textarea" @if($v->type == 'textarea') selected @endif> {{ __('locale.Textarea')}} </option>
                                                                                <option value="file" @if($v->type == 'file') selected @endif> {{ __('locale.File upload')}} </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                                            <select name="validation[]" class="form-control">
                                                                                <option value="required" @if($v->validation == 'required') selected @endif> {{ __('locale.Required')}} </option>
                                                                                <option value="nullable" @if($v->validation == 'nullable') selected @endif>  {{ __('locale.Optional')}} </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2 mt-md-0 mt-2 text-end">
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-danger btn-lg removeBtn w-100" type="button">
                                                                                    <i class="bi bi-x"></i>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mt-2 ">{{ __('locale.Save Method')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.gateway.manual.index') }}" class="btn btn-primary"><i class="bi bi-chevron-left"></i> {{ __('locale.Go Back')}} </a>
@endpush
@section('page-script')
<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@push('script')
    <script>

        $(function () {
            "use strict";


            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });
            $('.currency_symbol').text($('input[name=currency]').val());


            $('.addUserData').on('click', function () {
                var html = `
                <div class="col-md-12 user-data">
                    <div class="col">
                        <div class="mt-1 row input-group mb-md-0 mb-4">
                            <div class="col-md-4">
                                <input name="field_name[]" class="form-control" type="text" value="" required placeholder="{{ __('locale.Field Name')}}">
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="type[]" class="form-control">
                                    <option value="text" > {{ __('locale.Input Text')}} </option>
                                    <option value="textarea" > {{ __('locale.Textarea')}} </option>
                                    <option value="file"> {{ __('locale.File upload')}} </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="validation[]"
                                        class="form-control">
                                    <option value="required"> {{ __('locale.Required')}} </option>
                                    <option value="nullable">  {{ __('locale.Optional')}} </option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2 text-end">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger btn-lg removeBtn" type="button">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>`;
                $('.addedField').append(html)
            });

            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

            @if(old('currency'))
            $('input[name=currency]').trigger('input');
            @endif
        });

    </script>
@endpush
