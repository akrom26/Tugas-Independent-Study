<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Helpers\LogHelper;
use App\Models\Student;

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

    public function addSchoolClassAction(Request $request)
    {
        
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

    public function detailSchoolClass($id)
    {
        $data = SchoolClass::where('id_school_class', $id)->first();

        return view('admin.schoolclass.detail', compact('data'));
    }

    public function formEditSchoolClass($id)
    {
        $data = SchoolClass::where('id_school_class', $id)->first();

        return view('admin.schoolclass.edit', compact('data'));
    }

    public function updateSchoolClassAction(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'classroom' => $request->classroom,
                'sub_class' => $request->sub_class,
                'program' => $request->program,
                'major' => $request->major
            ];

            SchoolClass::where('id_school_class', $request->id)->update($data);
            DB::commit();

            $message = "Sukses edit data Kelas";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successUpdate']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal edit data Kelas => ".$th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorUpdate']);
        }
    }

    public function deleteSchoolClassAction($id) 
    {
        try {
            DB::beginTransaction();

            SchoolClass::where('id_school_class', $id)->delete();
            DB::commit();

            $message = "Sukses hapus data Kelas";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successDelete']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal hapus data Kelas => ".$th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorDelete']);
        }
    }

    public function addStudentClass(Request $request, $id)
    {
        $searchTerm = $request->search;
        if ($request->search) {
            $data = Student::where('name', 'LIKE', "%{$searchTerm}%")->where('id_school_class', null)->paginate(8);
        } else {
            $data = Student::where('id_school_class', null)->paginate(8);
        }

        return view('admin.schoolclass.add-student', compact('data', 'id'));
    }

    public function addStudentClassAction($id, $id_student)
    {
        try {
            DB::beginTransaction();
            $data = [
                'id_school_class' => $id
            ];

            Student::where('id_student', $id_student)->update($data);
            DB::commit();

            $message = "Sukses tambah siswa ke dalam kelas";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successAdd']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal tambah siswa ke dalam kelas => ".$th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorAdd']);
        }
    }

    public function moveStudentClass($id)
    {
        $data = SchoolClass::where('id_school_class', $id)->first();
        $students = Student::where('id_school_class', $id)->paginate(8);
        $schoolClasses = SchoolClass::all();

        return view('admin.schoolclass.move-student-class', compact('data', 'students', 'schoolClasses'));
    }

    public function moveStudentClassAction(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'id_school_class' => $request->id_school_class
            ];

            Student::where('id_student', $request->id)->update($data);
            DB::commit();

            $message = "Sukses memindahkan siswa";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successUpdate']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal memindahkan siswa => ".$th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorUpdate']);
        } 
    }

    public function moveStudentAllClassAction(Request $request)
    {
        try {
            DB::beginTransaction();
            $schoolClass = SchoolClass::where('id_school_class', $request->id)->first();

            foreach ($schoolClass->students as $student) {
                $data = [
                    'id_school_class' => $request->id_school_class
                ];
    
                Student::where('id_student', $student->id_student)->update($data);
            }
            
            DB::commit();

            $message = "Sukses memindahkan seluruh siswa";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successUpdate']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal memindahkan seluruh siswa => ".$th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorUpdate']);
        } 
    }
}
