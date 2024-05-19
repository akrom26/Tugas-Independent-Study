@extends('template.template')
@section('title', 'Manajemen User')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Manajemen User
            </div>
            <div class="card-body">
                <a type="button" href="{{Route('formAddUser')}}" class="mb-3 btn btn-primary">Tambah User</a>
                <div class="table-scrollable" >
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                           <tr>
                            <th scope="row">{{ $data->firstItem() + $loop->index }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->role }}</td>
                            
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{Route('formEditUser', ['id' => $item->id])}}" class=" btn btn-success"><i class="ti ti-edit"></i></a>
                                    <a data-role="{{auth()->user()->role}}" data-id="{{ $item->id }}" onclick="confirmDeleteUser(event)" type="button" class="btn btn-danger"><i class="ti ti-trash-x-filled"></i></a>
                                </div>
                            </td>
                           </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function confirmDeleteUser(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        const role = event.currentTarget.getAttribute('data-role');
        console.log(id);
        console.log(role);
        const url = "{!! url('administrator/user/delete-user') !!}";
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