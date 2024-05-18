@extends('template.template')
@section('title', 'Manajemen Kelas')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Form tambah data Kelas
            </div>
            <form method="POST" action="{{Route('updateSchoolClassAction')}}" id="formEditSchoolClass" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- data Kelas -->
                    <div class="card">
                        <div class="card-header">
                            Data Kelas
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input name="id" value="{{$data->id_school_class}}" hidden>
                                <label for="exampleFormControlInput1" class="form-label">Kelas *</label>
                                <input type="number" class="form-control" placeholder="Tingkat Kelas" name="classroom" required value="{{$data->classroom}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Sub-Kelas *</label>
                                <input type="text" class="form-control" placeholder="Nama Sub-Kelas" name="sub_class" required value="{{$data->sub_class}}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Program *</label>
                                <select class="form-control" name="program" required>
                                    <option>==Pilih Salah Satu==</option>
                                    <option value="khusus" @if($data->program == 'khusus') selected @endif>Khusus</option>
                                    <option value="reguler" @if($data->program == 'reguler') selected @endif>Reguler</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Jurusan *</label>
                                <select class="form-control" name="major" required>
                                    <option>==Pilih Salah Satu==</option>
                                    <option value="IPA" @if($data->major == 'IPA') selected @endif>IPA</option>
                                    <option value="AGAMA" @if($data->major == 'AGAMA') selected @endif>Agama</option>
                                </select>
                            </div>
            </form>
        </div>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-success" id="buttonEditSchoolClass">Update data kelas</button>
    </div>
</div>

@endsection
@section('script')
<script>
    // alert
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('buttonEditSchoolClass').addEventListener('click', function() {
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
                    document.getElementById('formEditSchoolClass').submit();
                }
            });
        });
    });
</script>

@endsection