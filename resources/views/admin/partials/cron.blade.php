
<div class="modal fade text-start bd-example-modal-lg" id="myModal" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('locale.Cron Job Setting Instruction')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 my-2">
                        <p class="cron-p-style">{{ __('locale.To Automate trade result run the')}}<code> {{ __('locale.cron job')}} </code>{{ __('locale.on your server. Set the Cron time as minimum as possible. Once per')}}<code> 5-15 </code>{{ __('locale.minutes is ideal')}}.</p>
                    </div>
                    <div class="col-md-12">
                        <label>{{ __('locale.Cron Command')}}</label>
                        <div class="input-group">
                            <input id="cron" type="text" class="form-control form-control-lg"
                                   value="curl -s {{route('cron')}}"  readonly="">
                                <span id="copybtn" class="input-group-text btn-success"
                                      title="" onclick="myFunction()" >{{ __('locale.Copy')}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 my-2">
                        <p class="cron-p-style">{{ __('locale.To automate practice trade result run the')}}<code> {{ __('locale.cron job')}} </code>{{ __('locale.on your server. Set the Cron time as minimum as possible. Once per')}}<code> 5-15 </code>{{ __('locale.minutes is ideal')}}.</p>
                    </div>
                    <div class="col-md-12">
                        <label>{{ __('locale.Cron Command')}}</label>
                        <div class="input-group">
                            <input id="practiceRef" type="text" class="form-control form-control-lg"
                                   value="curl -s {{route('practice.cron')}}"  readonly="">
                                <span id="copybtn" class="input-group-text btn-success"
                                      title="" onclick="myFunction3()" >{{ __('locale.Copy')}}</span>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 my-2">
                        <p class="cron-p-style">{{ __('locale.Crypto Currency Update Price')}}<code> {{ __('locale.cron job')}} </code>{{ __('locale.on your server. Set the Cron time as minimum as possible. Once per')}}<code> 5-15 </code>{{ __('locale.minutes is ideal')}}.</p>
                    </div>
                    <div class="col-md-12">
                        <label>{{ __('locale.Cron Command')}}</label>
                        <div class="input-group">
                            <input id="ref" type="text" class="form-control form-control-lg"
                                   value="curl -s {{route('crypt.price')}}"  readonly="">
                                <span id="copybtn" class="input-group-text btn-success"
                                      title="" onclick="myFunction2()" >{{ __('locale.Copy')}}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('locale.Close')}}</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        'use strict';
            $('.cron').on('click', function () {
                var modal = $('#myModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });
    </script>
@endpush


@push('script')
    @if(Carbon\Carbon::parse($general->last_cron_run)->diffInSeconds()>=900)
        <script>
            'use strict';
            function myFunction() {
                var copyText = document.getElementById("cron");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                notify('success', 'Url copied successfully ' + copyText.value);
            }
            function myFunction2() {
                var copyText = document.getElementById("ref");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                notify('success', 'Url copied successfully ' + copyText.value);
            }

              function myFunction3() {
                var copyText = document.getElementById("practiceRef");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                notify('success', 'Url copied successfully ' + copyText.value);
            }
        </script>
    @endif
@endpush
