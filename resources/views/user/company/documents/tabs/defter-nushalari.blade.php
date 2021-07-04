<div class="tab-pane fade show" id="defter_nushalari" aria-labelledby="dn-tab">
    <button class="btn btn-primary float-left" data-toggle="modal" data-target="#addMonthlyFile"
        data-whatever="@getbootstrap" onclick="selectMonthly('9')">Defter Nüshası Ekle</button>
    <div class=" table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover mt-2" id="dataTable">
            <thead class="thead-dark">
                <th>Dosya Adı</th>
                <th>Oluşturulma Tarihi</th>
                <th>Son Geçerlilik Tarihi</th>
                <th style="width: 15%">Dosya</th>
            </thead>
            <tbody>
                @forelse ( $defter_nushalari as $defter_nushasi )
                <tr>
                    <td>{{ $defter_nushasi->file->name }}</td>
                    <td>{{ Str::remove(' 00:00:00', $defter_nushasi->assigned_at) }}</td>
                    <td class="{{ $defter_nushasi->valid_date <= date('Y-m-d') ? 'table-danger' : 'table-success' }}">
                        {{ $defter_nushasi->valid_date }}
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm float-left mx-1"
                            onclick="window.open('{{ url('/files/monthly-files/' . $defter_nushasi->file->name) }}','_blank')">
                            <i class="fas fa-eye"></i></button>

                        <form class="float-left mx-1"
                            action="{{ route('download-file',['folder' => 'monthly-files', 'file_name' => $defter_nushasi->file->name]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fas fa-download"></i></button>
                        </form>
                        <form class="float-left mx-1"
                            action="{{ route('mandatory-file-delete',['file' => $defter_nushasi]) }}" method="post">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-times text-white"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td valign="top" colspan="5" class="dataTables_empty text-center">Tabloda herhangi bir veri mevcut
                        değil</td>
                </tr>
                @endforelse
            </tbody>
        </table>
</div>
</div>