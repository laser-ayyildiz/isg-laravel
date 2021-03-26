@extends('layouts.admin')
@section('title')Silinen İşletmeler - @endsection
@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Silinen İşletmeler</b></h1>
    </div>
    <div class="card-body">
        <div id="dataTable_filter">

            <div class="form-group col-md-4" style="float:right;">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                    placeholder="İşletme Adı ile ara...">
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>İşletme Adı</th>
                            <th>Sektör</th>
                            <th>Telefon</th>
                            <th>E-mail</th>
                            <th>Şehir</th>
                            <th>İlçe</th>
                            <th>Anlaşma Tarihi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($companies as $company)
                        <tr>
                            <td> <a href="/admin/{{ $company -> id }}/company">{{ $company -> name }}</a> </td>
                            <td> {{ $company -> type }} </td>
                            <td> {{ $company -> phone }} </td>
                            <td> {{ $company -> email }} </td>
                            <td> {{ $company -> city }} </td>
                            <td> {{ $company -> town }} </td>
                            <td> {{ $company -> contract_at }} </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>İşletme Adı</strong></td>
                            <td><strong>Sektör</strong></td>
                            <td><strong>Telefon</strong></td>
                            <td><strong>E-mail</strong></td>
                            <td><strong>Şehir</strong></td>
                            <td><strong>İlçe</strong></td>
                            <td><strong>Anlaşma Tarihi</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="float-right my-3">
    {{ $companies -> links() }}
</div>
@endsection
