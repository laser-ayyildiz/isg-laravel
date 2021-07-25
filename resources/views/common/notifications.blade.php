@extends('layouts.common')
@section('title')Bildirimler - @endsection
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {!! session('success') !!}
</div>
@elseif (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@endif
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Bildirimler</b></h1>
    </div>
    <div class="card-body">
        @if ($notifications->count() > 0)
        @if (auth()->user()->unreadNotifications->count() !== 0)
        <div class="float-md-left mb-3">
            <form action="{{ route('notifications.read-all') }}" method="post">
                @csrf
                <button class="btn btn-primary btn-sm" type="submit">Tümünü Okundu Olarak İşaretle</button>
            </form>
        </div>
        @endif
        <form action="{{ route('notifications.delete-all') }}" method="post">
            @method('DELETE')
            @csrf
            <div class="float-md-right mb-3">
                <button class="btn btn-danger btn-sm">Tümünü Sil</button>
            </div>
        </form>
        @endif


        <div class="table-responsive" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table" id="dataTable">
                <tbody>
                    @forelse ($notifications as $notification)
                    <tr>
                        <td @if ($notification->read_at === null) class="table-white" @else class="table-secondary"
                            style="opacity: 75%" @endif>
                            <div class="float-sm-right ">
                                @empty($notification->read_at)
                                <button href="#" class="btn btn-primary btn-sm btn-read" id="{{ $notification->id}}">
                                    <i class="fas fa-eye"></i> Okundu Olarak İşaretle
                                </button>
                                @endempty
                                <button href="#" class="btn btn-danger btn-sm mx-2 btn-delete"
                                    id="{{ $notification->id}}">
                                    <i class="fas fa-times"></i> Sil
                                </button>
                            </div>
                            <h5 class=" text-primary"><b>{{ $notification->data['type'] }}</b></h5>
                            <p><b>{{ $notification->data['text'] }}</b></p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <h2 class="text-center my-3">Hiç Bildiriminiz yok!</h2>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="float-right">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(".btn-read").click(function(e) {
        e.preventDefault();
        let node = $(this);
        $.ajax({
            type: "POST",
            url: '/notification/read/' + $(this).attr('id'),
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            success: function (data, status, xhr) {
                if (data) {
                    node.removeClass('btn-primary').addClass('btn-success');
                    node.children().removeClass('fa-eye').addClass('fa-check');
                }
            }
        });
    });

    $(".btn-delete").click(function(e) {
        e.preventDefault();
        let node2 = $(this);
        $.ajax({
            type: "DELETE",
            url: '/notification/delete/' + $(this).attr('id'),
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            success: function (data, status, xhr) {
                if (data) {
                    node2.text('');
                    node2.removeClass('btn-danger').addClass('btn-success');
                    node2.append('<i class="fas fa-check"></i> Silindi');
                }
            }
        });
    });
</script>
@endpush
@endsection
