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
                <div class="table-scrollable">
                    <table id="studentTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">NIS</th>
                                <th scope="col">NISN</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Kelengkapan data</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan diisi oleh DataTables -->
                        </tbody>
                    </table>
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
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#studentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('indexStudent') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'nis',
                    name: 'nis'
                },
                {
                    data: 'nisn',
                    name: 'nisn'
                },
                {
                    data: 'class',
                    name: 'class',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'progress',
                    name: 'progress',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10, // Default number of rows to display
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger'
                },
                {
                    extend: 'print',
                    className: 'btn btn-danger'
                }
            ]
        });
    });
</script>


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