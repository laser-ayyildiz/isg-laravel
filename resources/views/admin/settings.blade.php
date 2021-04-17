@extends('layouts.admin')
@section('title')Ayarlar - @endsection
@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Ayarlar</b></h1>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="card bg-light col-6">
                <div class="card-body" style="margin-top:10px;">
                    <img class="card-img-top w-50 d-block" style="margin: auto;" src="/images/users.png">

                    <h4 class="card-title"><b>Kullanıcılar</b></h4>
                    <p class="card-text">Çalışanlarınızı ve bilgilerini düzenleyin</p><a class="btn btn-primary"
                        role="button" href="{{ route('admin.osgb_employees') }}" style="margin-top: 30px;">Düzenle</a>
                </div>
            </div>

            <div class="card bg-light col-6">
                <div class="card-body">
                    <img class="card-img-top w-50 d-block" style="margin: auto; margin-top:10px;"
                        src="/images/user.png">

                    <h4 class="card-title"><b>Hesap</b></h4>
                    <p class="card-text">Hesap ayarlarınızı düzenleyin</p><a class="btn btn-primary" role="button"
                        href="{{ route('profile.index') }}" style="margin-top: 30px;">Düzenle</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
