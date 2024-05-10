@extends('template.template')
@section('title', 'Manajemen Kelas')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Manajemen Kelas
            </div>
            <div class="card-body">
                <a type="button" href="{{Route('formAddSchoolClass')}}" class="mb-3 btn btn-primary">Tambah Kelas</a>
                <div class="table-scrollable" >
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Sub Kelas</th>
                                <th scope="col">Program</th>
                                <th scope="col">Major</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                           <tr>
                            <th scope="row">{{ $data->firstItem() + $loop->index }}</th>
                            <td>{{ $item->classroom }}</td>
                            <td>{{ $item->sub_class }}</td>
                            <td>{{ $item->program }}</td>
                            <td>{{ $item->major }}</td>
                            
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{Route('detailSchoolClass', ['id' => $item->id_school_class])}}" class=" btn btn-warning"><i class="ti ti-info-circle-filled"></i></a>
                                    <a href="{{Route('formEditSchoolClass', ['id' => $item->id_school_class])}}" class=" btn btn-success"><i class="ti ti-edit"></i></a>
                                    <a data-role="{{auth()->user()->role}}" data-id="{{ $item->id_school_class }}" onclick="confirmDeleteSchoolClass(event)" type="button" class="btn btn-danger"><i class="ti ti-trash-x-filled"></i></a>
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