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
                                <input type="number" class="form-control" placeholder="Tempat Lahir siswa" name="place_birth" required>
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
                                <input type="file" class="form-control" name="photo" required accept="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Scan Kartu Keluarga (.pdf) *</label>
                                <input type="file" class="form-control" name="identity" required>
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
                            <h4>Data Ayah</h4>
                            <hr>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Ayah *</label>
                                <input type="text" class="form-control" placeholder="Nama ayah" name="father_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">NIK Ayah *</label>
                                <input type="number" class="form-control" placeholder="NIK ayah" name="father_nik" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tempat Lahir Ayah *</label>
                                <input type="number" class="form-control" placeholder="Tempat Lahir ayah" name="father_place_birth" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir Ayah *</label>
                                <input type="date" class="form-control" placeholder="Tanggal Lahir ayah" name="father_date_birth" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pendidikan Ayah *</label>
                                <select class="form-control" name="father_education" required>
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
                                <input type="string" class="form-control" placeholder="Pekerjaan ayah" name="father_job" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pendapatan Ayah *</label>
                                <input type="number" class="form-control" placeholder="Pendapatan ayah" name="father_income" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nomor HP Ayah *</label>
                                <input type="number" class="form-control" placeholder="Nomor HP ayah" name="father_phone" required>
                            </div>
                            <h4>Data Ibu</h4>
                            <hr>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Ibu *</label>
                                <input type="text" class="form-control" placeholder="Nama ibu" name="mother_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">NIK Ibu *</label>
                                <input type="number" class="form-control" placeholder="NIK ibu" name="mother_nik" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tempat Lahir Ibu *</label>
                                <input type="number" class="form-control" placeholder="Tempat Lahir ibu" name="mother_place_birth" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir Ibu *</label>
                                <input type="date" class="form-control" placeholder="Tanggal Lahir ibu" name="mother_date_birth" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pendidikan Ibu *</label>
                                <select class="form-control" name="mother_education" required>
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
                                <input type="string" class="form-control" placeholder="Pekerjaan ibu" name="mother_job" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pendapatan Ibu *</label>
                                <input type="number" class="form-control" placeholder="Pendapatan ibu" name="mother_income" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nomor HP Ibu *</label>
                                <input type="number" class="form-control" placeholder="Nomor HP ibu" name="mother_phone" required>
                            </div>
                    </div>
                </div>
                <!-- data sekolah sebelumnya -->
                <div class="card">
                    <div class="card-header">
                        Data Sekolah Sebelumnya
                    </div>
                    <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Sekolah *</label>
                                <input type="text" class="form-control" placeholder="Nama sekolah" name="name_origin_school" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tipe Sekolah *</label>
                                <input type="number" class="form-control" placeholder="Tipe sekolah" name="type_origin_school" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">NPSN *</label>
                                <input type="number" class="form-control" placeholder="NPSN" name="npsn_origin_school" required>
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
    @endsection