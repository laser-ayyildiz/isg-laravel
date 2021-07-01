<div class="tab-pane fade show" id="aylik_calismalar" role="tabpanel" aria-labelledby="ac-tab">
    @if ($defter_nushalari === null || $gozlem_raporlari === null)
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMonthlyFile"
        data-whatever="@getbootstrap">Yeni Dosya Yükle</button>
    @endif
    
    <table class="table table-bordered table-striped mb-5">
        <thead class="table-dark text-center">
            <th>Son Yüklenen Defter Nüshası</th>
            <th>Oluşturulma Tarihi</th>
            <th>Geçerlilik</th>
            <th>Dosya</th>
        </thead>
        <tbody class="text-center">
            @if ($defter_nushalari !== null)
            @foreach ( $defter_nushalari as $defter_nushasi )
            <tr>
                <td>{{ $defter_nushasi->file->name }}</td>
                <td>{{ Str::remove(' 00:00:00', $defter_nushasi->assigned_at) }}</td>
                <td>
                    @if ($defter_nushasi->valid_date <= date('Y-m-d')) <i class="fas fa-times text-danger"></i>
                        @else
                        <i class="fas fa-check text-success"></i>
                        @endif
                </td>
                <td>
                    <button class="btn btn-warning btn-sm float-left ml-5 mx-1"
                        onclick="window.open('{{ url('/files/monthly-files/' . $defter_nushasi->file->name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mx-1"
                        action="{{ route('download-file',['folder' => 'monthly-files', 'file_name' => $defter_nushasi->file->name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    <button class="btn btn-primary btn-sm float-left mx-1" data-toggle="modal"
                        data-target="#addMonthlyFile" data-whatever="@getbootstrap" onclick="selectMonthly('9')">
                        <i class="fas fa-plus text-white"></i></button>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">
                    <b>Bu ay defter nüshası eklenmedi</b>
                </td>
            </tr>
            @endif
        </tbody>
    </table>

    <table class="table table-bordered table-striped mt-5">
        <thead class="table-dark text-center">
            <th>Son Yüklenen Saha Gözlem Raporu</th>
            <th>Oluşturulma Tarihi</th>
            <th>Geçerlilik</th>
            <th>Dosya</th>
        </thead>
        <tbody class="text-center">
            @if ($gozlem_raporlari !== null)
            @foreach ( $gozlem_raporlari as $gozlem_raporu )
            <tr>
                <td>{{ $gozlem_raporu->file->name }}</td>
                <td>{{ Str::remove(' 00:00:00', $gozlem_raporu->assigned_at) }}</td>
                <td>
                    @if ($gozlem_raporu->valid_date <= date('Y-m-d')) <i class="fas fa-times text-danger"></i>
                        @else
                        <i class="fas fa-check text-success"></i>
                        @endif
                </td>
                <td>
                    <button class="btn btn-warning btn-sm float-left ml-5 mx-1"
                        onclick="window.open('{{ url('/files/monthly-files/' . $gozlem_raporu->file->name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mx-1"
                        action="{{ route('download-file',['folder' => 'monthly-files', 'file_name' => $gozlem_raporu->file->name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    <button class="btn btn-primary btn-sm float-left mx-1" data-toggle="modal"
                        data-target="#addMonthlyFile" data-whatever="@getbootstrap" onclick="selectMonthly('10')">
                        <i class="fas fa-plus text-white"></i></button>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">
                    <b>Bu ay saha gözlem raporu eklenmedi</b>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>