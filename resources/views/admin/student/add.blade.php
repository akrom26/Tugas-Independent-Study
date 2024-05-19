@extends('template.template')
@section('title', 'Manajemen Siswa')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Form tambah data siswa
            </div>
            <form method="POST" action="{{Route('addStudentAction')}}" id="formAddSiswa" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- data siswa -->
                    <div class="card">
                        <div class="card-header">
                            Data siswa
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama *</label>
                                <input type="text" class="form-control" placeholder="Nama siswa" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">NIK *</label>
                                <input type="number" class="form-control" placeholder="NIK siswa" name="nik" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">NIS *</label>
                                <input type="number" class="form-control" placeholder="NIS siswa" name="nis" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">NISN *</label>
                                <input type="number" class="form-control" placeholder="NISN siswa" name="nisn" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tempat Lahir *</label>
                                <input type="text" class="form-control" placeholder="Tempat Lahir siswa" name="place_birth" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir *</label>
                                <input type="date" class="form-control" placeholder="Tanggal Lahir siswa" name="date_birth" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin *</label>
                                <select class="form-control" name="gender" required>
                                    <option>==Pilih Salah Satu==</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Alamat siswa
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Provinsi *</label>
                                        @php
                                        $provinces = new App\Http\Controllers\AreaController;
                                        $provinces= $provinces->provinces();
                                        @endphp
                                        <select class="form-control" name="id_province" id="province" required>
                                            <option>==Pilih Salah Satu==</option>
                                            @foreach ($provinces as $item)
                                            <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kabupaten/Kota *</label>
                                        <select class="form-control" name="id_city" id="city" required>
                                            <option>==Pilih Salah Satu==</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kecamatan *</label>
                                        <select class="form-control" name="id_district" id="district" required>
                                            <option>==Pilih Salah Satu==</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Desa *</label>
                                        <select class="form-control" name="id_village" id="village" required>
                                            <option>==Pilih Salah Satu==</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kode POS *</label>
                                        <input type="number" class="form-control" placeholder="Kode Pos" name="pos_code" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Alamat *</label>
                                        <textarea class="form-control" name="address" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pas Foto *</label>
                                <input type="file" class="form-control" name="photo" required accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Scan Kartu Keluarga (.pdf) *</label>
                                <input type="file" class="form-control" name="identity" required accept=".pdf">
                            </div>

            </form>
        </div>
    </div>
    <!-- data orang tua -->
    <div class="card">

        <div class="card-header">
            Data Orang Tua Siswa
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Data orang tua sudah pernah dimasukan
            </button>
            <h4>Data Ayah</h4>
            <hr>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Ayah *</label>
                <input type="text" class="form-control" name="id_parent" id="id_parent" hidden>
                <input type="text" class="form-control" placeholder="Nama ayah" name="father_name" required id="father_name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIK Ayah *</label>
                <input type="number" class="form-control" placeholder="NIK ayah" name="father_nik" required id="father_nik">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tempat Lahir Ayah *</label>
                <input type="text" class="form-control" placeholder="Tempat Lahir ayah" name="father_place_birth" required id="father_place_birth">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir Ayah *</label>
                <input type="date" class="form-control" placeholder="Tanggal Lahir ayah" name="father_date_birth" required id="father_date_birth">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pendidikan Ayah *</label>
                <select class="form-control" name="father_education" required id="father_education">
                    <option>==Pilih Salah Satu==</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA/SMK</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pekerjaan Ayah *</label>
                <input type="string" class="form-control" placeholder="Pekerjaan ayah" name="father_job" required id="father_job">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pendapatan Ayah *</label>
                <select class="form-control" name="father_income" required id="father_income">
                    <option>==Pilih Salah Satu==</option>
                    <option value="Kurang dari Rp 500.000">Kurang dari Rp 500.000</option>
                    <option value="Rp 500.000 - 1.000.000">Rp 500.000 - 1.000.000</option>
                    <option value="Rp 1.000.000 - 2.000.000">Rp 1.000.000 - 2.000.000</option>
                    <option value="Rp 3.000.000 - 5.000.000">Rp 3.000.000 - 5.000.000</option>
                    <option value="Lebih dari Rp 5.000.000">Lebih dari Rp 5.000.000</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nomor HP Ayah *</label>
                <input type="number" class="form-control" placeholder="Nomor HP ayah" name="father_phone" required id="father_phone">
            </div>
            <h4>Data Ibu</h4>
            <hr>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Ibu *</label>
                <input type="text" class="form-control" placeholder="Nama ibu" name="mother_name" required id="mother_name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIK Ibu *</label>
                <input type="number" class="form-control" placeholder="NIK ibu" name="mother_nik" required id="mother_nik">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tempat Lahir Ibu *</label>
                <input type="text" class="form-control" placeholder="Tempat Lahir ibu" name="mother_place_birth" required id="mother_place_birth">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir Ibu *</label>
                <input type="date" class="form-control" placeholder="Tanggal Lahir ibu" name="mother_date_birth" required id="mother_date_birth">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pendidikan Ibu *</label>
                <select class="form-control" name="mother_education" required id="mother_education">
                    <option>==Pilih Salah Satu==</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA/SMK</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pekerjaan Ibu *</label>
                <input type="string" class="form-control" placeholder="Pekerjaan ibu" name="mother_job" required id="mother_job">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pendapatan Ibu *</label>
                <select class="form-control" name="mother_income" required id="mother_income">
                    <option>==Pilih Salah Satu==</option>
                    <option value="Kurang dari Rp 500.000">Kurang dari Rp 500.000</option>
                    <option value="Rp 500.000 - 1.000.000">Rp 500.000 - 1.000.000</option>
                    <option value="Rp 1.000.000 - 2.000.000">Rp 1.000.000 - 2.000.000</option>
                    <option value="Rp 3.000.000 - 5.000.000">Rp 3.000.000 - 5.000.000</option>
                    <option value="Lebih dari Rp 5.000.000">Lebih dari Rp 5.000.000</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nomor HP Ibu *</label>
                <input type="number" class="form-control" placeholder="Nomor HP ibu" name="mother_phone" required id="mother_phone">
            </div>
        </div>
    </div>
    <!-- data sekolah sebelumnya -->
    <div class="card">
        <div class="card-header">
            Data Sekolah Sebelumnya
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#originSchool">
                Data sekolah sudah pernah dimasukan
            </button>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Sekolah *</label>
                <input name="id_origin_school" hidden>
                <input type="text" class="form-control" placeholder="Nama sekolah" name="name_origin_school" required id="name_origin_school">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tipe Sekolah *</label>
                <select class="form-control" name="type_origin_school" required id="type_origin_school">
                    <option>==Pilih Salah Satu==</option>
                    <option value="Mts/Madrasah Tsanawiyah">Mts/Madrasah Tsanawiyah</option>
                    <option value="PKBM">PKBM</option>
                    <option value="Pondok Pesantren">Pondok Pesantren</option>
                    <option value="SMP Negeri/Swasta">SMP Negeri/Swasta</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">NPSN *</label>
                <input type="number" class="form-control" placeholder="NPSN" name="npsn_origin_school" required id="npsn_origin_school">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button type="button" class="btn btn-success" id="buttonAddSiswa">Tambah data siswa</button>
    </div>
</div>
</form>
</div>
</div>

<!-- Modal data orang tua -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cari data orang tua</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" name="searchParent" id="searchParent">
                        </div>
                    </div>
                </form>
                <hr>
                <div id="dataParent">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal data sekolah asal -->
<div class="modal fade" id="originSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cari data sekolah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" name="search" id="searchOriginSchool">
                        </div>
                    </div>
                </form>
                <hr>
                <div id="dataOriginSchool">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    // get data wilayah
    function onChangeSelect(url, id, name) {
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                $('#' + name).empty();
                $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                $.each(data, function(key, value) {
                    $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    }
    $(function() {
        $('#province').on('change', function() {
            onChangeSelect('{{ route("cities") }}', $(this).val(), 'city');
        });
        $('#city').on('change', function() {
            onChangeSelect('{{ route("districts") }}', $(this).val(), 'district');
        })
        $('#district').on('change', function() {
            onChangeSelect('{{ route("villages") }}', $(this).val(), 'village');
        })
    });

    // alert
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('buttonAddSiswa').addEventListener('click', function() {
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
                    document.getElementById('formAddSiswa').submit();
                }
            });
        });
    });
</script>

<!-- to real time search existing data -->
<script>
    $(document).ready(function() {
        $('#searchParent').keyup(function() {
            var searchText = $(this).val().trim();

            if (searchText !== '') {
                $.ajax({
                    url: '{{ Route("searchParent") }}',
                    type: 'GET',
                    data: {
                        searchParent: searchText
                    },
                    success: function(response) {
                        var dataParent = $('#dataParent');
                        dataParent.empty();

                        if (response.length > 0) {
                            var html = '<table class="table"><thead><tr><th scope="col">NIK Ayah</th><th scope="col">Nama Ayah</th></tr>';
                            $.each(response, function(index, parent) {
                                html += '<tr><th>' + parent.father_nik + '</th><th>' + parent.father_name + '</th><th><button class="btn btn-sm btn-success" onclick=getParent("' + parent.id_parent + '")>Pilih</button></tr>';
                            });
                            html += '</table>';
                            dataParent.append(html);
                        } else {
                            dataParent.text('Data orang tua tidak ditemukan');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#dataParent').empty();
            }
        });
    });
</script>

<script>
    function getParent(parentId) {
        $.ajax({
            url: '{{ route("detailParent", ["id" => ""]) }}' + parentId,
            method: 'GET',
            data: {
                parentId: parentId
            },
            success: function(response) {
                document.getElementById('father_name').value = response.father_name;
                document.getElementById('father_name').readOnly = true;
                document.getElementById('father_nik').value = response.father_nik;
                document.getElementById('father_nik').readOnly = true;
                document.getElementById('father_place_birth').value = response.father_birth_place;
                document.getElementById('father_place_birth').readOnly = true;
                document.getElementById('father_date_birth').value = response.father_birth_date;
                document.getElementById('father_date_birth').readOnly = true;
                document.getElementById('father_education').value = response.father_education;
                document.getElementById('father_education').readOnly = true;
                document.getElementById('father_job').value = response.father_job;
                document.getElementById('father_job').readOnly = true;
                document.getElementById('father_income').value = response.father_income;
                document.getElementById('father_income').readOnly = true;
                document.getElementById('father_phone').value = response.father_phone;
                document.getElementById('father_phone').readOnly = true;

                document.getElementById('mother_name').value = response.mother_name;
                document.getElementById('mother_name').readOnly = true;
                document.getElementById('mother_nik').value = response.mother_nik;
                document.getElementById('mother_nik').readOnly = true;
                document.getElementById('mother_place_birth').value = response.mother_birth_place;
                document.getElementById('mother_place_birth').readOnly = true;
                document.getElementById('mother_date_birth').value = response.mother_birth_date;
                document.getElementById('mother_date_birth').readOnly = true;
                document.getElementById('mother_education').value = response.mother_education;
                document.getElementById('mother_education').readOnly = true;
                document.getElementById('mother_job').value = response.mother_job;
                document.getElementById('mother_job').readOnly = true;
                document.getElementById('mother_income').value = response.mother_income;
                document.getElementById('mother_income').readOnly = true;
                document.getElementById('mother_phone').value = response.mother_phone;
                document.getElementById('mother_phone').readOnly = true;

                document.getElementById('id_parent').value = response.id_parent;
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan
                console.error('Terjadi kesalahan: ' + status);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('#searchOriginSchool').keyup(function() {
            var searchOriginSchool = $(this).val().trim();

            if (searchOriginSchool !== '') {
                $.ajax({
                    url: '{{ Route("searchOriginSchool") }}',
                    type: 'GET',
                    data: {
                        searchOriginSchool: searchOriginSchool
                    },
                    success: function(response) {
                        var dataOriginSchool = $('#dataOriginSchool');
                        dataOriginSchool.empty();

                        if (response.length > 0) {
                            var html = '<table class="table"><thead><tr><th scope="col">Nama Sekolah</th><th scope="col">NPSN</th></tr>';
                            $.each(response, function(index, school) {
                                html += '<tr><th>' + school.name + '</th><th>' + school.npsn + '</th><th><button class="btn btn-sm btn-success" onclick=getOriginSchool("' + school.id_origin_school + '")>Pilih</button></tr>';
                            });
                            html += '</table>';
                            dataOriginSchool.append(html);
                        } else {
                            dataOriginSchool.text('Data sekolah tidak ditemukan');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#dataOriginSchool').empty();
            }
        });
    });
</script>

<script>
    function getOriginSchool(id) {
        $.ajax({
            url: '{{ route("detailOriginSchool", ["id" => ""]) }}' + id,
            method: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                document.getElementById('name_origin_school').value = response.name;
                document.getElementById('name_origin_school').readOnly = true;
                document.getElementById('type_origin_school').value = response.type;
                document.getElementById('type_origin_school').readOnly = true;
                document.getElementById('npsn_origin_school').value = response.npsn;
                document.getElementById('npsn_origin_school').readOnly = true;

                document.getElementById('id_origin_school').value = response.id_origin_school;
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan
                console.error('Terjadi kesalahan: ' + status);
            }
        });
    }
</script>
@endsection