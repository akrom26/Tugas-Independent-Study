@extends('template.template')
@section('title', 'Manajemen Kelas')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Form update kelas
            </div>
            <div class="card-body">
                <form method="POST" action="{{Route('updateClassAction')}}" id="formAddKelas">
                    @csrf
                    <input name="id" type="text" value="{{$data->id_school_class}}" hidden>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Program *</label>
                        <select class="form-control" name="program" required>
                            <option value="">==Pilih Salah Satu==</option>
                            <option value="khusus">khusus</option>
                            <option value="regular">regular</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Sub-kelas *</label>
                        <select class="form-control" name="sub_kelas" required>
                            <option value="">==Pilih Salah Satu==</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jurusan *</label>
                        <select class="form-control" name="jurusan" required>
                            <option value="">==Pilih Salah Satu==</option>
                            <option value="IPA">IPA</option>
                            <option value="AGAMA">AGAMA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-success" id="buttonAddKelas">Update kelas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
    <script>
        // alert
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('buttonAddKelas').addEventListener('click', function() {
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
                        document.getElementById('formAddKelas').submit();
                    }
                });
            });
        });
    </script>
    @endsection