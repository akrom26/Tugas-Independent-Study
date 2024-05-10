<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Helpers\LogHelper;

class SchoolClassController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->search;
        if ($request->search) {
            $data = SchoolClass::where('name', 'LIKE', "%{$searchTerm}%")->paginate(8);
        } else {
            $data = SchoolClass::paginate(8);
        }
        return view('admin.schoolclass.index', compact('data'));
    }

    public function formAddSchoolClass()
    {
        return view('admin.schoolclass.add');
    }

    public function addSchoolClassAction(Request $request){
        
        try {
            DB::beginTransaction();
            $schoolclass = new SchoolClass();
            $schoolclass->classroom = $request->classroom;
            $schoolclass->sub_class = $request->sub_class;
            $schoolclass->program = $request->program;
            $schoolclass->major = $request->major;
            $schoolclass->save();

            DB::commit();

            $message = "Sukses tambah data Kelas";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successAdd']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal tambah data Kelas".$th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorAdd']);
        }
    }
}
