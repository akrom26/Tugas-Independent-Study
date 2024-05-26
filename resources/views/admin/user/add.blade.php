@extends('template.template')
@section('title', 'Manajemen User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Form tambah data user
            </div>
            <form method="POST" action="{{Route('addUserAction')}}" id="formAddUser" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama *</label>
                        <input type="text" class="form-control" placeholder="Nama" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Username *</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role *</label>
                        <select class="form-control" name="role" required>
                            <option>==Pilih Salah Satu==</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password *</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Re-Password *</label>
                        <input type="password" class="form-control" placeholder="Konfirmasi password" name="re_password" required>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-success" id="buttonAddUser">Tambah data user</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</form>

@endsection
@section('script')
<script>
    // alert
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('buttonAddUser').addEventListener('click', function() {
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
                    document.getElementById('formAddUser').submit();
                }
            });
        });
    });
</script>

@endsection