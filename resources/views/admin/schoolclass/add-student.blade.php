@extends('template.template')
@section('title', 'Manajemen Kelas')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Daftar siswa yang belum memilik kelas
            </div>
            <div class="card-body">
                <form action="" method="GET" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Cari berdasarkan nama siswa . . ." name="search" value="{{ request('search') }}">
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
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $data->firstItem() + $loop->index }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{Route('detailStudent', ['id' => $item->id_student])}}" class=" btn btn-warning"><i class="ti ti-info-circle-filled"></i></a>
                                        <a href="{{Route('addStudentClassAction', ['id' => $id, 'id_student' => $item->id_student])}}" class=" btn btn-success"><i class="ti ti-plus"></i></a>
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