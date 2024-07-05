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
                <div class="row">
                    <div class="col-md-2">
                        <a type="button" href="{{Route('formAdd')}}" class="mb-3 btn btn-primary">Tambah Siswa</a>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBulkStudent">
                            Tambah sekaligus
                        </button>
                    </div>
                </div>
                <form action="" method="GET" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Cari berdasarkan NISN . . ." name="search" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="gender" required>
                                <option>==Kelas==</option>
                                @foreach ($kelas as $k)
                                <option value="{{$k->id_school_class}}">{{$k->classroom}} {{$k->major}} {{$k->sub_class}} ({{$k->program}})</option>
                                @endforeach
                            </select>
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
                                <th scope="col">Kelengkapan data</th>
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
                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{ $item->completed_field }}" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $item->completed_field }}%">{{ $item->completed_field }}%</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{Route('detailStudent', ['id' => $item->id_student])}}" class=" btn btn-warning"><i class="ti ti-info-circle-filled"></i></a>
                                        <a href="{{Route('formEdit', ['id' => $item->id_student])}}" class=" btn btn-success"><i class="ti ti-edit"></i></a>
                                        <a data-role="{{auth()->user()->role}}" data-id="{{ $item->id_student }}" onclick="confirmDeleteSiswa(event)" type="button" class="btn btn-danger"><i class="ti ti-trash-x-filled"></i></a>
                                        <a href="{{ route('downloadAction', ['id' => $item->id_student]) }}" class="btn btn-primary {{ $item->completed_field < 100 ? 'disabled' : '' }}" {{ $item->completed_field < 100 ? 'disabled' : '' }}>
                                            <i class="ti ti-download"></i>
                                        </a>
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
<div class="modal fade" id="addBulkStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload file data siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                    Silahkan download template di bawah ini. Dan sesuaikan dengan data siswa.
                </div>
                <a href="https://docs.google.com/spreadsheets/d/1OhOiLMHLSaTfEpJb_zEMX5M5VoqMO6hiwNutf6bavDA/edit?usp=sharing" class="btn btn-success" target="_blank">Download template</a>
                <hr>
                <form id="addStudentCsv" method="POST" action="{{Route('bulkAddStudentAction')}}" enctype="multipart/form-data">
                    @csrf
                    <input name="role" value="admin" hidden>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">File .csv*</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-success" id="buttonAddStudentCsv">Upload siswa</button>
                    </div>
                </form>
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

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('buttonAddStudentCsv').addEventListener('click', function() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah anda yakin akan menyimpan data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('addStudentCsv').submit();
                }
            });
        });
    });
</script>
@endsection