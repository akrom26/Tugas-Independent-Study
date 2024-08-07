@extends('template.template')
@section('title', 'Manajemen Siswa')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Detail siswa
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <img style="padding: 0.5em;" src="{{Storage::url($data->photo)}}" class="img-thumbnail" alt="...">
                        </div>
                        <div class="row mt-2" style="text-align: center;">
                            <h5>{{$data->name}}</h5>
                        </div>
                        <div class="row" style="text-align: center;">
                            <h5>NISN : {{$data->nisn}}</h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="data-detail">
                            <div class="card">
                                <div class="card-header">
                                    Data Siswa
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Nama</th>
                                                <td>:</td>
                                                <td>{{$data->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>:</td>
                                                <td>{{$data->gender}}</td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>:</td>
                                                <td>{{$data->nik}}</td>
                                            </tr>
                                            <tr>
                                                <th>NIS</th>
                                                <td>:</td>
                                                <td>{{$data->nis}}</td>
                                            </tr>
                                            <tr>
                                                <th>NISN</th>
                                                <td>:</td>
                                                <td>{{$data->nisn}}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat / Tanggal lahir</th>
                                                <td>:</td>
                                                <td>{{$data->place_birth}} / {{ date('d-m-Y', strtotime($data->date_birth)) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Scan KK</th>
                                                <td>:</td>
                                                <td>
                                                    @if ($data->identity)
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Chek scan KK
                                                    </button>
                                                    @else
                                                    <p>Data KK tidak tersedia</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>:</td>
                                                <td>
                                                    <b>Desa : </b> {{ $data->village->name ?? '-' }}
                                                    <br>
                                                    <b>Kecamatan : </b> {{ $data->district->name ?? '-' }}
                                                    <br>
                                                    <b>Kabupaten / Kota : </b> {{$data->city->name ?? '-'}}
                                                    <br>
                                                    <b>Provinsi : </b> {{$data->province->name ?? '-'}}
                                                    <br>
                                                    <b>Alamat : </b> {{$data->address}}
                                                    <br>
                                                    <b>Kode pos : </b> {{$data->pos_code ?? '-'}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    Data Orang Tua
                                </div>
                                <div class="card-body">
                                    <table class="table table-responsive table-striped">
                                        <tbody>
                                            <tr>
                                                <th colspan="3" style="text-align: left;">Data Ayah</th>
                                            </tr>
                                            @if ($data->studentParent != null)
                                            <tr>
                                                <th>Nama</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->father_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->father_nik}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor HP</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->father_phone}}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat / Tanggal lahir</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->father_birth_place}} / {{ date('d-m-Y', strtotime($data->studentParent->father_birth_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pendidikan</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->father_education}}</td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->father_job}}</td>
                                            </tr>
                                            <tr>
                                                <th>Penghasilan</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->father_income}}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="3"><hr></th>
                                            </tr>
                                            @endif
                                            @if ($data->studentParent != null)
                                            <tr>
                                                <th colspan="3" style="text-align: left;">Data Ibu</th>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->mother_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->mother_nik}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor HP</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->mother_phone}}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat / Tanggal lahir</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->mother_birth_place}} / {{ date('d-m-Y', strtotime($data->studentParent->mother_birth_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pendidikan</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->mother_education}}</td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->mother_job}}</td>
                                            </tr>
                                            <tr>
                                                <th>Penghasilan</th>
                                                <td>:</td>
                                                <td>{{$data->studentParent->mother_income}}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data scan KK</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed src="{{ Storage::url($data->identity) }}" width="750" height="500" type='application/pdf'>
            </div>
            <div class="modal-footer">
                <a href="{{ Storage::url($data->identity) }}" class="btn btn-primary" download>Download</a>
            </div>
        </div>
    </div>
</div>
@endsection