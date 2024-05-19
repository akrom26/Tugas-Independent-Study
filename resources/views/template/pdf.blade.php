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
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .student-photo {
            text-align: center;
            margin-bottom: 20px;
        }
        .student-photo img {
            width: 150px; /* Sesuaikan lebar foto sesuai kebutuhan */
            border: 2px solid black; /* Bisa dihapus jika tidak diperlukan */
        }
        .label{
            width: 10em;
        }
        .th-alamat{
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

        /* CSS untuk properti cetak */
        @page {
            margin-top: 120px; /* Margin atas untuk memberikan ruang bagi kop surat */
        }
        .kop-surat {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            text-align: center;
            margin-bottom: 20em;
            z-index: -1; /* Menempatkan kop surat di bawah konten */
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="admin/assets/images/kop.png" alt="Kop Surat">
    </div>
    <div class="student-photo">
    @php
    $link = str_replace('/media/', '../storage/app/', $student['photo']);
    @endphp
    <img height="200" width="200" src="{{$link}}">

    </div>
    <h2>Data Diri Siswa</h2>
    <table>
        <tr>
            <th class="label">Nama</th>
            <td>{{$student['photo']}}</td>
        </tr>
        <tr>
            <th class="label">Tempat/Tanggal Lahir</th>
            <td>123456</td>
        </tr>
        <tr>
            <th class="label">Jenis Kelamin</th>
            <td>123456</td>
        </tr>
        <tr>
            <th class="label">NIK</th>
            <td>123456</td>
        </tr>
        <tr>
            <th class="label">NIS</th>
            <td>123456</td>
        </tr>
        <tr>
            <th class="label">NISN</th>
            <td>123456</td>
        </tr>
        <tr>
            <th class="label">Alamat</th>
            <td>
                <table class="table table-responsive">
                    <tr>
                        <th class="th-alamat">Provinsi</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="th-alamat">Kabupaten/kota</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="th-alamat">Kecamatan</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="th-alamat">Desa</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="th-alamat">Alamat Detail</th>
                        <td></td>
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
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">NIK</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Tempat/Tanggal Lahir</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Pendidikan</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Pekerjaan</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Pendapatan</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Nomor HP</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th colspan="2">Data Ibu</th>
        </tr>
        <tr>
            <th class="label">Nama</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">NIK</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Tempat/Tanggal Lahir</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Pendidikan</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Pekerjaan</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Pendapatan</th>
            <td>Pengusaha</td>
        </tr>
        <tr>
            <th class="label">Nomor HP</th>
            <td>Pengusaha</td>
        </tr>
    </table>

    <h2>Data Sekolah Asal</h2>
    <table>
        <tr>
            <th class="label">Nama Sekolah</th>
            <td>SMP Negeri 1 Jakarta</td>
        </tr>
        <tr>
            <th class="label">Alamat Sekolah</th>
            <td>Jl. Melati No. 2</td>
        </tr>
        <tr>
            <th class="label">Tahun Lulus</th>
            <td>2018</td>
        </tr>
    </table>

</body>
</html>
