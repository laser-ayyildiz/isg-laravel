<div class="tab-pane fade show" id="muhasebe_bilgileri"
    role="tabpanel" aria-labelledby="mb-tab">
    @isset($accountants['front'])
    <div name="front-acc">
        <h3 class="text-center mb-3"><u><b>Ön Muhasebe</b></u></h3>
        <div class="row">
            <div class="col-6">
                <label for="front_acc_name">
                    <h5><b>Ön Muhasebe Ad Soyad</h5></b>
                </label>
                <input class="form-control" type="text" name="front_acc_name" value="{{ $accountants['front']->name }}"
                    placeholder="Ad Soyad">
            </div>
            <div class="col-6">
                <label for="front_acc_email">
                    <h5><b>Ön Muhasebe Email</h5></b>
                </label>
                <input class="form-control" type="text" name="front_acc_email"
                    value="{{ $accountants['front']->email }}" placeholder="Email">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-6">
                <label for="front_acc_phone">
                    <h5><b>Ön Muhasebe Telefon No</h5></b>
                </label>
                <input class="form-control" type="text" name="front_acc_phone"
                    value="{{ $accountants['front']->phone }}" placeholder="05XXXXXXXXX" maxlength="11">
            </div>
        </div>
    </div>
    @endisset

    @isset($accountants['out'])
    <div name="out-acc">
        <h3 class="text-center"><u><b>Dış Muhasebe</b></u></h3>
        <div class="row my-3">
            <div class="col-6">
                <label for="out_acc_name">
                    <h5><b>Dış Muhasebe Ad Soyad</h5></b>
                </label>
                <input class="form-control" type="text" name="out_acc_name" value="{{ $accountants['out']->name }}"
                    placeholder="Ad Soyad">
            </div>
            <div class="col-6">
                <label for="out_acc_email">
                    <h5><b>Dış Muhasebe Email</h5></b>
                </label>
                <input class="form-control" type="email" name="out_acc_email" value="{{ $accountants['out']->email }}"
                    placeholder="Email">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-6">
                <label for="out_acc_phone">
                    <h5><b>Dış Muhasebe Telefon No</h5></b>
                </label>
                <input class="form-control" type="phone" name="out_acc_phone" value="{{ $accountants['out']->phone }}"
                    placeholder="05XXXXXXXXX" maxlength="11">
            </div>
        </div>
    </div>
    @endisset

    @if ($accountants['front'] == null && $accountants['out'] == null)
    <div class="text-center">
        <h3><b>Muhasabe kaydı bulunamadı!</b></h3>
    </div>
    @endif

</div>