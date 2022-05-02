@extends('layouts.app')

@section('content')
<div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Extensions</h4><div class="card-search"></div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover custom-data-bs-table">
                    <thead class="table-dark">
                                <tr>
                                    <th scope="col">{{ __('locale.Extension')}}</th>
                                    <th scope="col">{{ __('locale.Status')}}</th>
                                    <th scope="col">{{ __('locale.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($extensions as $extension)
                                <tr>
                                    <td data-label="{{ __('locale.Extension')}}">
                                        <div class="row centerize">
                                            <div class="col-md-3 thumb">
                                                <img src="{{ getImage(imagePath()['extensions']['path'] .'/'. $extension->image,'36x36') }}" alt="{{ __($extension->name) }}" class="plugin_bg"></div>
                                            <span class="col-md-9 name">{{ __($extension->name) }}</span>
                                        </div>
                                    </td>
                                    <td data-label="{{ __('locale.Status')}}">
                                        @if($extension->status == 1)
                                            <span class="badge bg-success">{{ __('locale.Active')}}</span>
                                        @else
                                            <span class="badge bg-warning">{{ __('locale.Disabled')}}</span>
                                        @endif
                                    </td>
                                    <td data-label="{{ __('locale.Action')}}">
                                        <button type="button" class="btn-icon btn-warning rounded ms-1 editBtn"
                                                data-name="{{ __($extension->name) }}"
                                                data-shortcode="{{ json_encode($extension->shortcode) }}"
                                                data-action="{{ route('admin.extensions.update', $extension->id) }}"
                                                data-original-title="{{ __('locale.Configure')}}">
                                            <i class="bi bi-gear"></i>
                                        </button>
                                        <button type="button" class="btn-icon btn-dark rounded ms-1 helpBtn"
                                                data-description="{{ __($extension->description) }}"
                                                data-support="{{ __($extension->support) }}"
                                                data-original-title="{{ __('locale.Help')}}">
                                            <i class="bi bi-question-circle"></i>
                                        </button>
                                        @if($extension->status == 0)
                                            <button type="button"
                                                    class="btn-icon btn-success rounded ms-1 activateBtn"
                                                    data-bs-toggle="modal" data-bs-target="#activateModal"
                                                    data-id="{{ $extension->id }}" data-name="{{ __($extension->name) }}"
                                                    data-original-title="{{ __('locale.Enable')}}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        @else
                                            <button type="button"
                                                    class="btn-icon btn-danger ms-1 deactivateBtn"
                                                    data-bs-toggle="modal" data-bs-target="#deactivateModal"
                                                    data-id="{{ $extension->id }}" data-name="{{ __($extension->name) }}"
                                                    data-original-title="{{ __('locale.Disable')}}">
                                                <i class="bi bi-eye-slash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




    {{-- EDIT METHOD MODAL --}}
    <div id="editModal" class="modal fade text-start" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('locale.Update Extension')}}: <span class="extension-name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col">
                            <label class="col-md-12 control-label fw-bold">{{ __('locale.Script')}} <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <textarea name="script" class="form-control" rows="8" placeholder="{{ __('locale.Paste your script with proper key')}}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                        <button type="submit" class="btn btn-primary" id="editBtn">{{ __('locale.Update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ACTIVATE METHOD MODAL --}}
    <div id="activateModal" class="modal fade text-start" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('locale.Extension Activation Confirmation')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.extensions.activate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>{{ __('locale.Are you sure to activate')}} <span class="fw-bold extension-name"></span> {{ __('locale.extension')}}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('locale.Activate')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DEACTIVATE METHOD MODAL --}}
    <div id="deactivateModal" class="modal fade text-start" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('locale.Extension Disable Confirmation')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.extensions.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>{{ __('locale.Are you sure to disable')}} <span class="fw-bold extension-name"></span> {{ __('locale.extension')}}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                        <button type="submit" class="btn btn-danger">{{ __('locale.Disable')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- HELP METHOD MODAL --}}
    <div id="helpModal" class="modal fade text-start" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('locale.Need Help')}}?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@push('script')
    <script>
        $(function () {
            "use strict";

            $('.activateBtn').on('click', function () {
                var modal = $('#activateModal');
                modal.find('.extension-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
            });

            $('.deactivateBtn').on('click', function () {
                var modal = $('#deactivateModal');
                modal.find('.extension-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
            });

            $('.editBtn').on('click', function () {
                var modal = $('#editModal');
                var shortcode = $(this).data('shortcode');

                modal.find('.extension-name').text($(this).data('name'));
                modal.find('form').attr('action', $(this).data('action'));

                var html = '';
                $.each(shortcode, function (key, item) {
                    html += `<div class="col">
                        <label class="col-md-12 control-label fw-bold">${item.title}<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input name="${key}" class="form-control" placeholder="--" value="${item.value}" required>
                        </div>
                    </div>`;
                })
                modal.find('.modal-body').html(html);

                modal.modal('show');
            });

            $('.helpBtn').on('click', function () {
                var modal = $('#helpModal');
                var path = "{{ asset(imagePath()['extensions']['path']) }}";
                modal.find('.modal-body').html(`<div class="mb-2">${$(this).data('description')}</div>`);
                if ($(this).data('support') != 'na') {
                    modal.find('.modal-body').append(`<img src="${path}/${$(this).data('support')}">`);
                }
                modal.modal('show');
            });


        });

    </script>
@endpush
