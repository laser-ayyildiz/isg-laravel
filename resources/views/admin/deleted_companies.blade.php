@extends('layouts.admin')
@section('title')Silinen İşletmeler - @endsection
@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Silinen İşletmeler</b></h1>
    </div>
    <div class="card-body">
        <div id="dataTable_filter">
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
                            <th>Silinme Tarihi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
