<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ClassController extends Controller
{
    public function index()
    {
        $data = SchoolClass::all();
        return view('admin.kelas.index', compact('data'));
    }

    public function formAdd()
    {
        return view('admin.kelas.add');
    }

    public function addClassAction(Request $request)
    {
        // untuk mengecek tidak boleh ada yang kosong
        if ($request->program == null || $request->sub_kelas == null || $request->jurusan == null) {
            return redirect()->back();
        } 
        $kelas = new SchoolClass();
        $kelas->sub_class = $request->sub_kelas;
        $kelas->program = $request->program;
        $kelas->major = $request->jurusan;
        $kelas->save();

        return redirect()->back();
    }

    public function formEdit($id)
    {
        $data = SchoolClass::where('id_school_class', $id)->first();
        return view('admin.kelas.edit', compact('data'));
    }

    public function updateClassAction(Request $request)
    {
        $data = [
            'sub_class' => $request->sub_kelas,
            'program' => $request->program,
            'major' => $request->jurusan
        ];

        SchoolClass::where('id_school_class', $request->id)->update($data);

        return redirect()->back();
    }
}
