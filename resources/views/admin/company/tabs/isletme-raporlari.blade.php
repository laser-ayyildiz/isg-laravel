<div class="tab-pane fade show {{ session('tab') == 'isletme_rapor' ? 'active' : '' }}" id="isletme_rapor" 
    aria-labelledby="ir-tab">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addMandatoryFile"
        data-whatever="@getbootstrap">Zorunlu Doküman Ekle</button>
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover mt-2" id="dataTable">
            <thead class="thead-dark">
                <tr>
                    <th>Dosya Türü</th>
                    <th>Dosya Adı</th>
                    <th>Oluşturulma Tarihi</th>
                    <th>Yüklenme Tarihi</th>
                    <th style="width:  12%">İndir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mandatory_files as $file )
                <tr>
                    <td><b>{{ $file->type->file_name }}</b></td>
                    <td><b>{{ $file->file->name }}</b></td>
                    <td><b>{{ $file->assigned_at }}</b></td>
                    <td><b>{{ $file->updated_at }}</b></td>
                    <td class="text-center">
                        <form class="float-left mx-1"
                            action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $file->file->name]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fas fa-download"></i></button>
                        </form>
                        <form class="float-left mx-1"
                            action="{{ route('delete-file',['file' => $file->file, 'type' => 'CompanyToFile']) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>