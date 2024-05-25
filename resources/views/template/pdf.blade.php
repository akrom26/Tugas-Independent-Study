<!DOCTYPE html>
<html>

<head>
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .student-photo {
            text-align: center;
            margin-bottom: 20px;
        }

        .student-photo img {
            width: 150px;
            /* Sesuaikan lebar foto sesuai kebutuhan */
            border: 2px solid black;
            /* Bisa dihapus jika tidak diperlukan */
        }

        .label {
            width: 10em;
        }

        .th-alamat {
            width: 5em;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100%;
            max-width: 600px;
        }

        @page {
            margin: 100px 50px;
            /* Margin atas yang lebih besar untuk header */
        }

        header {
            position: fixed;
            top: -50px;
            /* Sesuaikan posisi atas header */
            left: 0px;
            right: 0px;
            height: 100px;
            text-align: center;
            line-height: 35px;
        }

        body {
            margin: 0;
            padding-top: 100px;
            /* Jarak antara header dan konten utama */
        }

        .page-break {
            page-break-before: always;
            margin-top: 50px;
            /* Sesuaikan jarak jika perlu */
        }
    </style>
</head>

<body>
    <header>
        <img src="admin/assets/images/kop.png" alt="Logo">
    </header>

    <div class="content">
        <div class="student-photo">
            <img height="200" width="200" src="{{ $image }}">
        </div>
        <h2>Data Diri Siswa</h2>
        <table>
            <tr>
                <th class="label">Nama</th>
                <td>{{$student['name']}}</td>
            </tr>
            <tr>
                <th class="label">Tempat/Tanggal Lahir</th>
                <td>{{$student['place_birth']}} / {{$student['date_birth']}}</td>
            </tr>
            <tr>
                <th class="label">Jenis Kelamin</th>
                <td>{{$student['gender']}}</td>
            </tr>
            <tr>
                <th class="label">NIK</th>
                <td>{{$student['nik']}}</td>
            </tr>
            <tr>
                <th class="label">NIS</th>
                <td>{{$student['nis']}}</td>
            </tr>
            <tr>
                <th class="label">NISN</th>
                <td>{{$student['nisn']}}</td>
            </tr>
            <tr>
                <th class="label">Alamat</th>
                <td>
                    <table class="table table-responsive">
                        <tr>
                            <th class="th-alamat">Provinsi</th>
                            <td>{{$address['province']}}</td>
                        </tr>
                        <tr>
                            <th class="th-alamat">Kabupaten/kota</th>
                            <td>{{$address['city']}}</td>
                        </tr>
                        <tr>
                            <th class="th-alamat">Kecamatan</th>
                            <td>{{$address['district']}}</td>
                        </tr>
                        <tr>
                            <th class="th-alamat">Desa</th>
                            <td>{{$address['village']}}</td>
                        </tr>
                        <tr>
                            <th class="th-alamat">Alamat Detail</th>
                            <td>{{$student['address']}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <h2>Data Orang Tua Siswa</h2>
        <table>
            <tr>
                <th colspan="2">Data Ayah</th>
            </tr>
            <tr>
                <th class="label">Nama</th>
                <td>{{$parent['father_name']}}</td>
            </tr>
            <tr>
                <th class="label">NIK</th>
                <td>{{$parent['father_nik']}}</td>
            </tr>
            <tr>
                <th class="label">Tempat/Tanggal Lahir</th>
                <td>{{$parent['father_birth_place']}}/{{$parent['father_birth_date']}}</td>
            </tr>
            <tr>
                <th class="label">Pendidikan</th>
                <td>{{$parent['father_education']}}</td>
            </tr>
            <tr>
                <th class="label">Pekerjaan</th>
                <td>{{$parent['father_job']}}</td>
            </tr>
            <tr>
                <th class="label">Pendapatan</th>
                <td>{{$parent['father_income']}}</td>
            </tr>
            <tr>
                <th class="label">Nomor HP</th>
                <td>{{$parent['father_phone']}}</td>
            </tr>
            <tr>
                <th colspan="2">Data Ibu</th>
            </tr>
            <tr>
                <th class="label">Nama</th>
                <td>{{$parent['mother_name']}}</td>
            </tr>
            <tr>
                <th class="label">NIK</th>
                <td>{{$parent['mother_nik']}}</td>
            </tr>
            <tr>
                <th class="label">Tempat/Tanggal Lahir</th>
                <td>{{$parent['mother_birth_place']}}/{{$parent['mother_birth_date']}}</td>
            </tr>
            <tr>
                <th class="label">Pendidikan</th>
                <td>{{$parent['mother_education']}}</td>
            </tr>
            <tr>
                <th class="label">Pekerjaan</th>
                <td>{{$parent['mother_job']}}</td>
            </tr>
            <tr>
                <th class="label">Pendapatan</th>
                <td>{{$parent['mother_income']}}</td>
            </tr>
            <tr>
                <th class="label">Nomor HP</th>
                <td>{{$parent['mother_phone']}}</td>
            </tr>
        </table>

        <h2 style="page-break-before: always;">Data Sekolah Asal</h2>
        <table>
            <tr>
                <th class="label">Nama Sekolah</th>
                <td>{{$school['name']}}</td>
            </tr>
            <tr>
                <th class="label">Tipe Sekolah</th>
                <td>{{$school['type']}}</td>
            </tr>
            <tr>
                <th class="label">NPSN</th>
                <td>{{$school['npsn']}}</td>
            </tr>
        </table>
    </div>
</body>

</html>