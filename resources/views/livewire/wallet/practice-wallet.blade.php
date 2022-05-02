<div class="row" style="margin:0 0;">
    <div class="col-lg-12 col-md-12">
        <div class="row bg-wallet-active p-1 rounded">
            <a href="{{route('user.home')}}" style="display: contents;">
                <div class="col-6 test-start">
                        <div class="fs-bold fs-4 text-white">Practice Account</div>
                        <div class="fs-bold fs-4 text-warning">
                            {{$general->cur_sym}}<livewire:partials.practice-balance/></div>
                </div>
                <div class="col-6 text-end">
                    <a href="javascript:void(0)"><button class="btn btn-outline-warning btn-sm"
                            data-bs-toggle="modal" data-bs-target="#practiceAmount">
                            <i class="bi bi-plus"></i>Top Up</button></a>
                </div>
            </a>
        </div>
        <div class="row bg-wallet p-1 rounded mt-1">
            <a href="{{route('user.home.trade')}}" style="display: contents;">
                <div class="col-6 test-start">
                    <div class="fs-bold fs-4 text-white">Trade Account</div>
                    <div class="fs-bold fs-4 text-success">
                        {{$general->cur_sym}}<livewire:partials.balance/></div>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('user.deposit') }}"><button class="btn btn-outline-light btn-sm">
                            <i class="bi bi-plus"></i>Deposit</button></a>
                    <a href="{{ route('user.withdraw') }}"><button class="mt-1 btn btn-outline-light btn-sm">
                            <i class="bi bi-plus"></i>Withdraw</button></a>
                </div>
            </a>
        </div>
    </div>
</div>
