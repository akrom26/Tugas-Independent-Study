@extends('template.template')
@section('title', 'Manajemen Siswa')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Manajemen Siswa
            </div>
            <div class="card-body">
                <a type="button" href="{{Route('formAdd')}}" class="mb-3 btn btn-primary">Tambah Siswa</a>
                <form action="" method="GET" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Cari berdasarkan NISN . . ." name="search" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                <div class="table-scrollable">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">NIS</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $data->firstItem() + $loop->index }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nis }}</td>
                                @if($item->schoolClass == null)
                                <td>
                                <span class="badge rounded-pill text-bg-danger" style="background-color: #EE2737 !important;">Belum memiliki kelas</span>
                                </td>
                                @else
                                <td>{{$item->schoolClass->classroom}} - {{$item->schoolClass->major}} - {{$item->schoolClass->sub_class}} ({{$item->schoolClass->program}})</td>
                                @endif
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{Route('detailStudent', ['id' => $item->id_student])}}" class=" btn btn-warning"><i class="ti ti-info-circle-filled"></i></a>
                                        <a href="{{Route('formEdit', ['id' => $item->id_student])}}" class=" btn btn-success"><i class="ti ti-edit"></i></a>
                                        <a data-role="{{auth()->user()->role}}" data-id="{{ $item->id_student }}" onclick="confirmDeleteSiswa(event)" type="button" class="btn btn-danger"><i class="ti ti-trash-x-filled"></i></a>
                                        <a href="{{Route('downloadAction', ['id' => $item->id_student])}}" class=" btn btn-primary"><i class="ti ti-download"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $data->appends(['search' => request('search'), 'jenjang' => request('jenjang')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function confirmDeleteSiswa(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        const role = event.currentTarget.getAttribute('data-role');
        console.log(id);
        console.log(role);
        const url = "{!! url('administrator/student/delete-student') !!}";
        console.log(url);
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url + "/" + id;
            }
        });
    }
</script>
@endsection