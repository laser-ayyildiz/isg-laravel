@extends('layouts.common')
@section('title')Profil - @endsection
@section('content')
@if (session('statusSuccess'))
<div class="alert alert-success">
    {{ session('statusSuccess') }}
</div>
@elseif (session('statusFail'))
<div class="alert alert-danger">
    {{ session('statusFail') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row mb-3">
    <div class="col-lg-6" style="margin: auto;">
        <div class="card shadow-lg mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Profil Resmi</p>
            </div>
            <div class="card-body text-center shadow">
                <img class="img-thumbnail image rounded-circle mb-3 mt-4"
                    src="{{ Auth::user()->profile_photo_path }}">
                <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-10">
                            <div class="custom-file">
                                <input type="file" name="avatar" class="custom-file-input" id="avatar" required>
                                <label class="custom-file-label" for="avatar"><b>Profil Resmi Yükle</b></label>
                            </div>
                        </div>
                        <div class="col-2">
                            <input type="submit" name="update-picture" class="btn btn-success float-right"
                                value="Değiştir">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-lg mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Parola</p>
            </div>
            <div class="card-body text-center shadow">
                <form action="{{ route('profile.updatePassword') }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label style="float:left;"><b>Mevcut Parola</b></label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" name="oldPassword" autocomplete="off" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><a><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></a></span>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label style="float:left;"><b>Yeni Parola</b></label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" minlength="8" name="newPassword" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><a><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="float:left;"><b>Yeni Parola Tekrar</b></label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" minlength="8" name="newPasswordAgain" required>
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
                        <form action="{{ route('profile.updateIdCard') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="email"><strong>E-mail</strong></label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">
                                            <strong>İsim</strong><br></label>
                                        <input name="name" class="form-control" type="text"
                                            value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                            </div>
                            @if (!auth()->user()->hasRole('CompanyAdmin'))
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
                                        <label for="recruitment_date">
                                            <strong>İşe Giriş Tarihi</strong><br></label>
                                        <input name="recruitment_date" id="recruitment_date" class="form-control"
                                            type="date" value="{{ auth()->user()->recruitment_date }}" required>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <button name="bilgi_kaydet" type="submit" style="width:200px;"
                                class="btn btn-success">Kaydet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    recruitment_date.max = new Date().toISOString().split("T")[0];
</script>
<script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("fa-eye-slash");
          $('#show_hide_password i').removeClass("fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("fa-eye-slash");
          $('#show_hide_password i').addClass("fa-eye");
        }
      });
    });
    $('#avatar').on('change',function(){
        $(this).next('.custom-file-label').html($(this).val());
    });
</script>
@endpush
@endsection