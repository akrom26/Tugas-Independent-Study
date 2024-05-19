@extends('template.template')
@section('title', 'Manajemen Kelas')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Daftar siswa kelas {{$data->classroom}} - {{$data->major}} - {{$data->sub_class}} - ({{$data->program}})
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#moveAllStudent">
                    Pindahkan seluruh siswa <i class="ti ti-logout"></i>
                </button>
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
                            @foreach ($students as $item)
                            <tr>
                                <th scope="row">{{ $students->firstItem() + $loop->index }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{Route('detailStudent', ['id' => $item->id_student])}}" class=" btn btn-warning"><i class="ti ti-info-circle-filled"></i></a>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id_student}}">
                                            <i class="ti ti-logout"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $students->appends(['search' => request('search'), 'jenjang' => request('jenjang')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($students as $item)
<div class="modal fade" id="exampleModal{{$item->id_student}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form perpindahan kelas siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{Route('moveStudentClassAction')}}">
                    @csrf
                    <input type="text" value="{{$item->id_student}}" name="id" hidden>
                    <label>Kelas tujuan * </label>
                    <select class="form-select" aria-label="Default select example" required name="id_school_class">
                        <option selected>== Pilih kelas tujuan ==</option>
                        @foreach ($schoolClasses as $schoolClass)
                        <option value="{{$schoolClass->id_school_class}}">{{$schoolClass->classroom}} - {{$schoolClass->major}} - {{$schoolClass->sub_class}} - ({{$schoolClass->program}})</option>
                        @endforeach
                    </select>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Pindahkan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="moveAllStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form perpindahan kelas siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{Route('moveStudentAllClassAction')}}">
                    @csrf
                    <input type="text" value="{{$data->id_school_class}}" name="id" hidden>
                    <label>Kelas tujuan * </label>
                    <select class="form-select" aria-label="Default select example" required name="id_school_class">
                        <option selected>== Pilih kelas tujuan ==</option>
                        @foreach ($schoolClasses as $schoolClass)
                        <option value="{{$schoolClass->id_school_class}}">{{$schoolClass->classroom}} - {{$schoolClass->major}} - {{$schoolClass->sub_class}} - ({{$schoolClass->program}})</option>
                        @endforeach
                    </select>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah yakin anda akan memindahkan semua siswa ke kelas tujuan?')">Pindahkan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection