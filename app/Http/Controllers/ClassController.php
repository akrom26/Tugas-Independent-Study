<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

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
}
