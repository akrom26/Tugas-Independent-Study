<?php

namespace App\Http\Controllers;

use App\Http\Helpers\LogHelper;
use App\Models\OriginSchool;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $data = Student::paginate(8);

        return view('admin.student.index', compact('data'));
    }

    public function formAdd()
    {
        return view('admin.student.add');
    }

    public function addStudentAction(Request $request)
    {
        try {
            DB::beginTransaction();

            $originSchool = new OriginSchool();
            $originSchool->name = $request->name_origin_school;
            $originSchool->type = $request->type_origin_school;
            $originSchool->npsn = $request->npsn_origin_school;
            $originSchool->save();

            if ($request->id_parent == null) {
                $parent = new StudentParent();
                $parent->father_name = $request->father_name;
                $parent->father_nik = $request->father_nik;
                $parent->father_birth_date = $request->father_date_birth;
                $parent->father_birth_place = $request->father_place_birth;
                $parent->father_job = $request->father_job;
                $parent->father_education = $request->father_education;
                $parent->father_income = $request->father_income;
                $parent->father_phone = $request->father_phone;
                $parent->mother_name = $request->mother_name;
                $parent->mother_nik = $request->mother_nik;
                $parent->mother_birth_date = $request->mother_date_birth;
                $parent->mother_birth_place = $request->mother_place_birth;
                $parent->mother_job = $request->mother_job;
                $parent->mother_education = $request->mother_education;
                $parent->mother_income = $request->mother_income;
                $parent->mother_phone = $request->mother_phone;
                $parent->save();
                $id_parent = $parent->id_parent;
            } else {
                $id_parent = $request->id_parent;
            }


            $student = new Student();
            $student->id_parent = $id_parent;
            $student->id_origin_school = $originSchool->id_origin_school;
            $student->id_province = $request->id_province;
            $student->id_city = $request->id_city;
            $student->id_district = $request->id_district;
            $student->id_village = $request->id_village;
            $student->nis = $request->nis;
            $student->nisin = $request->nisn;
            $student->nik = $request->nik;
            $student->date_birth = $request->date_birth;
            $student->place_birth = $request->place_birth;
            $student->gender = $request->gender;
            $student->photo = $request->photo->store('public/pas_foto');
            $student->identity = $request->identity->store('public/scan_kk');
            $student->address = $request->address;
            $student->pos_code = $request->pos_code;
            $student->name = $request->name;
            $student->status = $request->status;
            $student->save();

            DB::commit();

            $message = "Sukses tambah data siswa dengan nama: " . $request->name . '-> ' . auth()->user()->username;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successAdd']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal tambah data siswa dengan nama: " . $request->name . '-> ' . auth()->user()->username . 'reason : ' . $th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorAdd']);
        }
    }
}
