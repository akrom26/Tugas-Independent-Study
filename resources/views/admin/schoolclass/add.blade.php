@extends('template.template')
@section('title', 'Manajemen Kelas')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Form tambah data Kelas
            </div>
            <form method="POST" action="{{Route('addSchoolClassAction')}}" id="formAddSchoolClass" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- data Kelas -->
                    <div class="card" style="padding: 2%">
                        <div class="card-header">
                            Data Kelas
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Kelas *</label>
                                <input type="number" class="form-control" placeholder="Tingkat Kelas" name="classroom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Sub-Kelas *</label>
                                <input type="text" class="form-control" placeholder="Nama Sub-Kelas" name="sub_class" required>
                            </div>
                            
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Program *</label>
                                <select class="form-control" name="program" required>
                                    <option>==Pilih Salah Satu==</option>
                                    <option value="khusus">Khusus</option>
                                    <option value="reguler">Reguler</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Jurusan *</label>
                                <select class="form-control" name="major" required>
                                    <option>==Pilih Salah Satu==</option>
                                    <option value="IPA">IPA</option>
                                    <option value="AGAMA">Agama</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
 
    <div class="mb-3">
        <button type="button" class="btn btn-success" id="buttonAddSchoolClass">Tambah data kelas</button>
    </div>
</div>
</form>
</div>
</div>

@endsection
@section('script')
<script>
   

    // alert
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('buttonAddSchoolClass').addEventListener('click', function() {
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
                    document.getElementById('formAddSchoolClass').submit();
                }
            });
        });
    });
</script>

@endsection