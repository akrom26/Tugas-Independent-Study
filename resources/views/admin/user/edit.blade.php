@extends('template.template')
@section('title', 'Manajemen User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Form tambah edit user
            </div>
            <form method="POST" action="{{Route('editUserAction')}}" id="formUpdateUser" enctype="multipart/form-data">
                @csrf
                <input type="text" name="id" value="{{$data->id}}" hidden>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama *</label>
                        <input type="text" class="form-control" placeholder="Nama" name="name" required value="{{$data->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Username *</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" required value="{{$data->username}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role *</label>
                        <select class="form-control" name="role" required>
                            <option>==Pilih Salah Satu==</option>
                            <option value="admin" selected>admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password *</label>
                        <br>
                        <small class="text-danger">Kosongi apabila tidak diubah</small>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Re-Password *</label>
                        <br>
                        <small class="text-danger">Kosongi apabila tidak diubah</small>
                        <input type="password" class="form-control" placeholder="Konfirmasi password" name="re_password">
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-success" id="buttonUpdateUser">Update data user</button>
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
        document.getElementById('buttonUpdateUser').addEventListener('click', function() {
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
                    document.getElementById('formUpdateUser').submit();
                }
            });
        });
    });
</script>

@endsection