@extends('layouts.admin')
@section('title')Ayarlar - @endsection
@section('content')
<div class="card shadow-lg border">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Ayarlar</b></h1>
    </div>
    <div class="card-group">
        <div class="card bg-light"><img class="card-img-top w-50 d-block" style="margin: auto;"
                src="/images/users.png">
            <div class="card-body" style="margin-top:10px;">
                <h4 class="card-title"><b>Kullanıcılar</b></h4>
                <p class="card-text">Çalışanlarınızı ve bilgilerini düzenleyin</p><a class="btn btn-primary"
                    role="button" href="{{ route('osgb_employees') }}" style="margin-top: 30px;">Düzenle</a>
            </div>
        </div>
        <div class="card bg-light"><img class="card-img-top w-50 d-block" style="margin: auto; margin-top:10px;"
                src="/images/user.png">
            <div class="card-body">
                <h4 class="card-title"><b>Hesap</b></h4>
                <p class="card-text">Hesap ayarlarınızı düzenleyin</p><a class="btn btn-primary" role="button"
                    href="{{ route('profile') }}" style="margin-top: 30px;">Düzenle</a>
            </div>
        </div>
    </div>
</div>
@endsection
