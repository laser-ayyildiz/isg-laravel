@extends('layouts.admin')
@section('title')Profil - @endsection
@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div class="row mb-3">
    <div class="col-lg-6" style="margin: auto; ">
        <div class="card shadow-lg mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Profil Resmi</p>
            </div>
            <div class="card-body text-center shadow">
                <img class="img-thumbnail mb-3 mt-4" src="/uploads/profile_pictures/{{auth()->user()->profile_photo_path}}" width="218" height="300">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>Profil Resmi Yükle</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" name="update-picture"style="width:200px;" class="pull-right btn btn-success" value="Değiştir">
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-lg mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Şifre</p>
            </div>
            <div class="card-body text-center shadow">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <label style="float:left;"><b>Mevcut Şifre</b></label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" name="old-password" autocomplete="off" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><a><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="float:left;"><b>Yeni Şifre</b></label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" minlength="8" name="new-password"
                                required>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><a><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="float:left;"><b>Yeni Şifre Tekrar</b></label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" minlength="8" name="new-password-again"
                                 required>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><a><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button name="update-password" type="submit" style="width:200px;float:left"
                            class="btn btn-success">Değiştir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="margin: auto;">
        <div class="row mb-3">
            <div class="col">
                <div class="card shadow-lg mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Kullanıcı Bilgileri</p>
                    </div>
                    <div class="card-body shadow">
                        <form action="/admin/profile" method="POST">
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="email"><strong>E-mail</strong></label>
                                        <input class="form-control" type="email" name="username" readonly value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="first_name">
                                            <strong>İsim</strong><br></label>
                                        <input name="firstname" class="form-control" type="text" value="{{ auth()->user()->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="tc"><strong>T.C. Kimlik No</strong><br></label>
                                        <input class="form-control" type="phone" minlength="11" maxlength="11" name="tc"
                                            value="{{ auth()->user()->tc }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="phone">
                                            <strong>Telefon No</strong><br></label>
                                        <input name="phone" class="form-control" type="phone"
                                            pattern="(\d{4})(\d{3})(\d{2})(\d{2})" maxlength="11" minlength="11"
                                            value="{{ auth()->user()->phone }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="start_date">
                                            <strong>İşe Giriş Tarihi</strong><br></label>
                                        <input name="start_date" class="form-control" type="date" value="{{ auth()->user()->recruitment_date }}" required>
                                    </div>
                                </div>
                            </div>

                            <button name="bilgi_kaydet" id="bilgi_kaydet" type="submit" style="width:200px;"
                                class="btn btn-success">Kaydet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
