@extends('layouts.admin')
@section('title')Bildirimler - @endsection
@section('content')
<div class="card-header border bg-light">
    <h1 class="text-dark mb-1" style="text-align: center;"><b>Bildirimler</b></h1>
</div>
<div class="card shadow-lg">
    <div class="card-body">

        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table my-0" id="dataTable">
                <tbody>
                    <tr>
                        <td>
                            <p>
                                <h5></h5>
                            </p>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
