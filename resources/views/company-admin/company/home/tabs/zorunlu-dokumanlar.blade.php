<div class="tab-pane fade show active" id="zorunlu_dokumanlar" role="tabpanel" aria-labelledby="zd-tab">
    <table class="table table-striped table-borderless">
        <tbody>
            @for ($i = 1; $i <= 8; $i++) <tr>
                <td>
                    {{ $file_names[$i] }}
                </td>
                @if (isset($mandatory_files->where('file_type',$i)->first()->file->name))
                <td>
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                </td>
                <td>
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $mandatory_files->where('file_type',$i)->first()->file->name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $mandatory_files->where('file_type',$i)->first()->file->name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                </td>
                @else
                <td>
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                </td>
                @endif
                </tr>
                @endfor
        </tbody>
    </table>
</div>