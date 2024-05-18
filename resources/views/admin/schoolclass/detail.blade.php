@extends('template.template')
@section('title', 'Manajemen Kelas')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Detail kelas
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Data Kelas
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive table-striped">
                                    <tr>
                                        <th>Kelas</th>
                                        <td>:</td>
                                        <td>{{$data->classroom}}</td>
                                    </tr>
                                    <tr>
                                        <th>Sub-Kelas</th>
                                        <td>:</td>
                                        <td>{{$data->sub_class}}</td>
                                    </tr>
                                    <tr>
                                        <th>Program</th>
                                        <td>:</td>
                                        <td>{{$data->program}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jurusan</th>
                                        <td>:</td>
                                        <td>{{$data->major}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Siswa</th>
                                        <td>:</td>
                                        <td>{{count($data->students)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Data Siswa
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive table-striped">
                                    <tr>
                                        <th>No.</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                    </tr>
                                    @foreach($data->students as $student)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <a href="{{Route('detailStudent', ['id' => $student->id_student])}}">
                                            <td>{{$student->nisn}}</td>
                                        </a>
                                        <td>{{$student->name}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection