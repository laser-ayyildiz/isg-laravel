@extends('layouts.admin')
@section('title')Onay Bekleyenler - @endsection
@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@elseif (session('warning'))
<div class="alert alert-warning">
    {{ session('warning') }}
</div>
@endif

<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Onay Bekleyen Değişiklikler</b></h1>
    </div>
    <div class="card-body">
        <div class="table table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover data-table" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th>İşletme Adı</th>
                        <th>Telefon</th>
                        <th>E-mail</th>
                        <th>Düzenleyen</th>
                        <th>Düzenlenme Tarihi</th>
                        <th>Düzenle/Sil</th>
                    </tr>
                </thead>
                <tbody style="cursor: pointer">
                    @forelse ($demands as $key => $demand)
                    <tr>
                        <td>{{ Str::title($demand->company->name) }}</td>
                        <td>{{ $demand->company->phone }}</td>
                        <td>{{ $demand->company->email }}</td>
                        <td>{{ Str::title($demand->user->name) }}</td>
                        <td>{{ $demand->created_at }}</td>

                        @if (array_key_exists("name",$demand->toArray()))
                        <td><button class="btn btn-primary" data-toggle="modal"
                                data-target="#change{{ $key }}">Düzenle</button>
                        </td>
                        <div class="modal fade" id="change{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Düzenle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Düzenlenme tarihi:<b> {{ $demand->created_at }}</b> </p>
                                        <p>Düzenleyen:<b> {{ Str::title($demand->user->name) }}</b>
                                        </p>

                                        <div class="row mt-1">
                                            <div class="col-sm-12">
                                                <label for="name"><strong>İşletme
                                                        Adı:&emsp;</strong></label>
                                                <input class="form-control" type="text" placeholder="Adı" name="name"
                                                    value="{{ Str::title($demand->company->name) }}">
                                                @if ($demand->name !== null)
                                                <label for="new_name"><strong>İşletme
                                                        Adı:&emsp;</strong></label>
                                                <input class="form-control" type="text" placeholder="Adı"
                                                    name="new_name" value="{{ Str::title($demand->name) }}">
                                                @endif
                                            </div>
                                        </div>

                                        @if ($demand->email !== null)
                                        <div class="row mt-3">
                                            <div class="col-sm-4">
                                                <label for="eski_mail"><strong>Eski Mail
                                                        Adresi</strong></label>
                                                <input class="form-control" type="email" name="eski_mail"
                                                    value="{{ $demand->company->email  }}" readonly>

                                                <label class="mt-1" for="email" style="color:red"><strong>Yeni
                                                        Mail Adresi:&emsp;</strong></label>
                                                <input class="form-control" style="border: 2px solid red;" type="email"
                                                    placeholder="E-mail" name="email" value="{{ $demand->email }}"
                                                    required>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="row mt-3">
                                            @if ($demand->type !== null)
                                            <div class="col-sm-6">
                                                <label for="eski_type"><strong>Eski
                                                        Sektör</strong></label>
                                                <input class="form-control" type="text" placeholder="Sektör"
                                                    name="eski_type" value="{{ $demand->company->type }}" readonly>
                                                <label class="mt-1" for="comp_type" style="color:red"><strong>Yeni
                                                        Sektör</strong></label>
                                                <input class="form-control" style="border: 2px solid red;"
                                                    placeholder="İşletmenin çalıştığı sektör:" list="comp_type"
                                                    name="comp_type" autocomplete="off" value="{{ $demand->type }}"
                                                    reqiured />
                                            </div>
                                            @endif

                                            @if ($demand->phone !== null)
                                            <div class="col-sm-6">
                                                <label for="eski_phone"><strong>Eski Telefon
                                                        No</strong></label>
                                                <input class="form-control" type="tel" name="eski_phone"
                                                    value="{{ $demand->company->phone }}" readonly>
                                                <label class="mt-1" for="phone" style="color:red"><strong>Yeni
                                                        Telefon No</strong></label>
                                                <input class="form-control" style="border: 2px solid red;" type="tel"
                                                    name="phone" placeholder="Tel: 0XXXXXXXXXX"
                                                    pattern="(\d{4})(\d{3})(\d{2})(\d{2})" value="{{ $demand->phone }}"
                                                    maxlength="11" required>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="row mt-3">
                                            @if ($demand->city !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_city"><strong>Eski
                                                        Şehir</strong></label>
                                                <input class="form-control" type="text" name="eski_town"
                                                    value="{{ $demand->company->city }}" readonly>
                                                <label class="mt-1" for="city" style="color:red"><strong>Yeni
                                                        Şehir</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" placeholder="Şehir" name="city"
                                                    value="{{ $demand->city }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->town !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_town"><strong>Eski
                                                        İlçe</strong></label>
                                                <input class="form-control" type="text" placeholder="İlçe"
                                                    name="eski_city" value="{{ $demand->company->town }}" readonly>
                                                <label class="mt-1" for="town" style="color:red"><strong>Yeni
                                                        İlçe</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" placeholder="İlçe" name="town"
                                                    value="{{ $demand->town }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->contract_at !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_contract_date"><strong>Eski
                                                        Anlaşma
                                                        Tarihi</strong></label>
                                                <input class="form-control" type="date" name="eski_contract_date"
                                                    value="{{ $demand->company->contract_at }}" readonly>
                                                <label class="mt-1" for="contract_date" style="color:red"><strong>Yeni
                                                        Anlaşma
                                                        Tarihi:&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="date" placeholder="Anlaşma Tarihi" name="contract_date"
                                                    value="{{ $demand->contract_at }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->bill_address !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_bill_address"><strong>Eski Fatura
                                                        Adresi</strong></label>
                                                <input class="form-control" type="text" name="eski_bill_address"
                                                    value="{{ $demand->company->bill_address }}" readonly>
                                                <label class="mt-1" for="bill_address" style="color:red"><strong>Yeni
                                                        Fatura Adresi&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" placeholder="Adres" name="bill_address"
                                                    value="{{ $demand->bill_address }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->address !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_address"><strong>Eski İş Yeri
                                                        Adres</strong></label>
                                                <input class="form-control" type="text" name="eski_address"
                                                    value="{{ $demand->company->address }}" readonly>
                                                <label class="mt-1" for="address" style="color:red"><strong>Yeni İş Yeri
                                                        Adres&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" placeholder="Adres" name="address"
                                                    value="{{ $demand->address }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->remi_freq !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_remi_freq"><strong>Eski Ziyaret
                                                        Sıklığı(Ay)</strong></label>
                                                <input class="form-control" type="text" name="eski_remi_freq"
                                                    value="{{ $demand->company->remi_freq }}" readonly>
                                                <label class="mt-1" for="remi_freq" style="color:red"><strong>Yeni
                                                        Ziyaret
                                                        Sıklığı(Ay):&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" placeholder="Ziyaret Sıklığı" name="remi_freq"
                                                    value="{{ $demand->remi_freq }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->employer !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_is_veren"><strong>Eski İşveren
                                                        Ad
                                                        Soyad</strong></label>
                                                <input class="form-control" type="text" name="eski_is_veren"
                                                    value="{{ $demand->company->employer }}" readonly>
                                                <label class="mt-1" for="is_veren" style="color:red"><strong>Yeni
                                                        İşveren Ad Soayd:&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" placeholder="İşveren Ad Soyad" name="is_veren"
                                                    value="{{ $demand->employer }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->mersis_no !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_mersis_no"><strong>Eski Mersis
                                                        No</strong></label>
                                                <input class="form-control" type="text" name="eski_mersis_no"
                                                    value="{{ $demand->company->mersis_no }}" readonly>
                                                <label class="mt-1" for="mersis_no" style="color:red"><strong>Yeni
                                                        Mersis
                                                        No:&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" placeholder="Mersis No" name="mersis_no"
                                                    value="{{ $demand->mersis_no }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->sgk_sicil_no !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_sgk_sicil"><strong>Eski SGK
                                                        Sicil
                                                        No</strong></label>
                                                <input class="form-control" type="text" name="eski_contract_date"
                                                    value="{{ $demand->company->sgk_sicil_no }}" readonly>
                                                <label class="mt-1" for="sgk_sicil" style="color:red"><strong>Yeni
                                                        SGK Sicil
                                                        No:&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" name="sgk_sicil" value="{{ $demand->sgk_sicil_no }}"
                                                    required>
                                            </div>
                                            @endif

                                            @if ($demand->vergi_no !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_vergi_no"><strong>Eski Vergi
                                                        No</strong></label>
                                                <input class="form-control" type="text" name="eski_vergi_no"
                                                    value="{{ $demand->company->vergi_no }}" readonly>
                                                <label class="mt-1" for="vergi_no" style="color:red"><strong>Yeni
                                                        Vergi No:&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" name="vergi_no" value="{{ $demand->vergi_no }}"
                                                    required>
                                            </div>
                                            @endif

                                            @if ($demand->vergi_dairesi !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_vergi_dairesi"><strong>Eski
                                                        Vergi
                                                        Dairesi</strong></label>
                                                <input class="form-control" type="text" name="eski_vergi_dairesi"
                                                    value="{{ $demand->company->vergi_dairesi }}" readonly>
                                                <label class="mt-1" for="vergi_dairesi" style="color:red"><strong>Yeni
                                                        Vergi
                                                        Dairesi:&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" name="vergi_dairesi"
                                                    value="{{ $demand->vergi_dairesi }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->katip_is_yeri_id !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_katip_is_yeri_id"><strong>Eski
                                                        Katip İş Yeri ID</strong></label>
                                                <input class="form-control" type="text" name="eski_katip_is_yeri_id"
                                                    value="{{ $demand->company->katip_is_yeri_id }}" readonly>
                                                <label class="mt-1" for="katip_is_yeri_id"
                                                    style="color:red"><strong>Yeni
                                                        Katip İş Yeri
                                                        ID:&emsp;</strong></label>
                                                <input class="form-control mb-3 style=" border: 2px solid red;"
                                                    type="text" name="katip_is_yeri_id"
                                                    value="{{ $demand->katip_is_yeri_id }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->katip_kurum_id !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_katip_kurum_id"><strong>Eski
                                                        Katip
                                                        Kurum ID</strong></label>
                                                <input class="form-control" type="text" name="eski_katip_kurum_id"
                                                    value="{{ $demand->company->katip_kurum_id }}" readonly>
                                                <label class="mt-1" for="katip_kurum_id" style="color:red"><strong>Yeni
                                                        Katip Kurum
                                                        ID:&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" name="katip_kurum_id"
                                                    value="{{ $demand->katip_kurum_id }}" required>
                                            </div>
                                            @endif

                                            @if ($demand->sube_kodu !== null)
                                            <div class="col-sm-4">
                                                <label for="eski_sube_kodu"><strong>Şube Adı</strong></label>
                                                <input class="form-control" type="text" name="eski_sube_kodu"
                                                    value="{{ $demand->company->sube_kodu }}" readonly>
                                                <label class="mt-1" for="katip_kurum_id" style="color:red"><strong>Yeni
                                                       Şube Adı&emsp;</strong></label>
                                                <input class="form-control mb-3" style="border: 2px solid red;"
                                                    type="text" name="sube_kodu"
                                                    value="{{ $demand->sube_kodu }}" required>
                                            </div>
                                            @endif
                                        </div>

                                        {{-- modal footer --}}
                                        <div class="mt-3">
                                            <form
                                                action="{{ route('admin.change_validate.update',['demand' => $demand]) }}"
                                                method="post">
                                                @csrf
                                                <div class="float-left">
                                                    <button name="rejectUpdate" type="submit"
                                                        class="btn btn-danger btn-lg">Düzenlemeleri
                                                        Reddet</button>
                                                </div>
                                                <div class="float-right">
                                                    <button name="acceptUpdate" type="submit"
                                                        class="btn btn-primary btn-lg">Düzenlemeleri
                                                        Onayla</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <td><button class="btn btn-danger" data-toggle="modal"
                                data-target="#delete{{ $key }}">Sil</button>
                        </td>
                        <div class="modal fade" id="delete{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>
                                            <b> {{ $demand->company->name }} </b> işletmesini silmek istediğinizden
                                            emin misiniz?
                                        </h3>
                                        <h5>İsteği gönderen: <b>{{ $demand->user->name }}</b></h5>
                                        <h5>İsteği gönderilme tarihi: <b>{{ $demand->created_at }}</b></h5>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.change_validate.delete',['demand' => $demand]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary mr-auto"
                                                name="rejectDelete">Silme talebini
                                                reddet</button>
                                            <button type="submit" class="btn btn-danger ml-auto"
                                                name="acceptDelete">İşletmeyi Sil</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td valign="top" colspan="6" class="dataTables_empty text-center">
                            <h4><b>Onay Bekleyen Bir Değişiklik Bulunamadı!</b></h4>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="float-right">
            {{ $demands->links() }}
        </div>
    </div>


    <!-- Silme Modal -->

</div>

@endsection
