@extends('layouts.admin')
@section('title')Yetkilendirilen İşveren/vekilleri - @endsection
@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@endif
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Yetkilendirilen İşveren/vekilleri</b></h1>
    </div>
    <div class="card-body">
        <div class="table table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover data-table" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th>Ad Soyad</th>
                        <th>İşletme</th>
                        <th>E-mail</th>
                        <th>Telefon Numarası</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companyAdmins as $admin)
                    <tr>
                        <td>{{ $admin->user->name }}</td>
                        <td>{{ $admin->company->name }}</td>
                        <td>{{ $admin->user->email }}</td>
                        <td>{{ $admin->user->phone }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            Hiçbir İşveren/Vekili Yetkilendirilmesi Yapılmadı!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
