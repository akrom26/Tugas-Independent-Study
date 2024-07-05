<?php

namespace App\Http\Controllers;

use App\Http\Helpers\LogHelper;
use App\Models\OriginSchool;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Faker\Core\File;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->search;
        if ($searchTerm) {
            $data = Student::where('nisn', 'LIKE', "%{$searchTerm}%")
                ->orderBy('completed_field', 'asc')
                ->paginate(8);
        } else {
            $data = Student::orderBy('completed_field', 'asc')->paginate(8);
        }

        $kelas = SchoolClass::all();

        return view('admin.student.index', compact('data', 'kelas'));
    }

    public function formAdd()
    {
        return view('admin.student.add');
    }

    public function addStudentAction(Request $request)
    {
        try {
            // check existing nik or nisn
            $student = Student::where('nik', $request->nik)->orWhere('nisn', $request->nisn)->first();
            if ($student != null) {
                $message = "Gagal tambah data NIK siswa telah terdaftar: " . $request->name . '-> ' . auth()->user()->username;
                LogHelper::Log($message);
                return redirect()->back()->with(['flash' => 'errorAddExistingStudent']);
            }

            // checking existing parent data
            if ($request->id_parent == null) {
                $parent = StudentParent::where('father_nik', $request->father_nik)->where('mother_nik', $request->mother_nik)->first();
                if ($parent != null) {
                    $message = "Gagal tambah data orang tua siswa telah terdaftar: " . $request->name . '-> ' . auth()->user()->username;
                    LogHelper::Log($message);
                    return redirect()->back()->with(['flash' => 'errorAddExistingParent']);
                }
            }

            // checking existing origin school
            if ($request->id_origin_school == null) {
                $originSchool = OriginSchool::where('npsn', $request->npsn)->first();
                if ($originSchool != null) {
                    $message = "Gagal tambah data sekolah telah terdaftar: " . $request->name . '-> ' . auth()->user()->username;
                    LogHelper::Log($message);
                    return redirect()->back()->with(['flash' => 'errorAddExistingOriginSchool']);
                }
            }

            DB::beginTransaction();

            if ($request->id_origin_school == null) {
                $originSchool = new OriginSchool();
                $originSchool->name = $request->name_origin_school;
                $originSchool->type = $request->type_origin_school;
                $originSchool->npsn = $request->npsn_origin_school;
                $originSchool->save();
                $id_origin_school = $originSchool->id_origin_school;
            } else {
                $id_origin_school = $request->id_origin_school;
            }


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
            $student->id_origin_school = $id_origin_school;
            $student->id_province = $request->id_province;
            $student->id_city = $request->id_city;
            $student->id_district = $request->id_district;
            $student->id_village = $request->id_village;
            $student->nis = $request->nis;
            $student->nisn = $request->nisn;
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
            $student->completed_field = 100;
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

    public function detailStudent($id)
    {
        $data = Student::where('id_student', $id)->first();

        return view('admin.student.detail', compact('data'));
    }

    public function formEdit($id)
    {
        $data = Student::where('id_student', $id)->first();

        return view('admin.student.edit', compact('data'));
    }

    public function updateStudentAction(Request $request)
    {
        try {
            // check existing nik or nisn
            $student = Student::where('nik', $request->nik)->orWhere('nisn', $request->nisn)->first();
            if ($student != null && ($student->id_student != $request->id)) {
                $message = "Gagal tambah data NIK siswa telah terdaftar: " . $request->name . '-> ' . auth()->user()->username;
                LogHelper::Log($message);
                return redirect()->back()->with(['flash' => 'errorAddExistingStudent']);
            }

            // checking existing parent data
            if ($student->studentParent != null) {
                if (($student->studentParent->father_nik != $request->father_nik) || ($student->studentParent->mother_nik != $request->mother_nik)) {
                    $parent = StudentParent::where('father_nik', $request->father_nik)->where('mother_nik', $request->mother_nik)->first();
                    if ($parent != null) {
                        $message = "Gagal tambah data orang tua siswa telah terdaftar: " . $request->name . '-> ' . auth()->user()->username;
                        LogHelper::Log($message);
                        return redirect()->back()->with(['flash' => 'errorAddExistingParent']);
                    }
                }
            }

            // checking existing origin school
            if ($student->originSchool != null) {
                $originSchool = OriginSchool::where('npsn', $request->npsn_origin_school)->first();
                if ($request->npsn_origin_school != $student->originSchool->npsn) {
                    if ($originSchool != null) {
                        $message = "Gagal tambah data sekolah telah terdaftar: " . $request->name . '-> ' . auth()->user()->username;
                        LogHelper::Log($message);
                        return redirect()->back()->with(['flash' => 'errorAddExistingOriginSchool']);
                    }
                }
            }

            DB::beginTransaction();
            // logic untuk update origin school
            // 1. Update data yang sudah ada
            // 2. Menambah data dari fitur existing

            // 1. Update data yang sudah ada
            if ($student->originSchool == null) {
                $originSchool = 0;
            } else {
                $originSchool = $student->originSchool->id_origin_school;
            }
            if ($request->id_origin_school == $originSchool || $request->id_origin_school == null) {
                $existingOriginData = OriginSchool::where('id_origin_school', '!=', $request->id_origin_school)->where('npsn', $request->npsn)->first();
                if ($existingOriginData) {
                    $message = "Gagal tambah data sekolah telah terdaftar: " . $request->name . '-> ' . auth()->user()->username;
                    LogHelper::Log($message);
                    return redirect()->back()->with(['flash' => 'errorAddExistingOriginSchool']);
                } else if ($request->id_origin_school == null) {
                    $originSchool = new OriginSchool();
                    $originSchool->name = $request->name_origin_school;
                    $originSchool->type = $request->type_origin_school;
                    $originSchool->npsn = $request->npsn_origin_school;
                    $originSchool->save();
                    $id_origin_school = $originSchool->id_origin_school;
                } else {
                    $data = [
                        'name' => $request->name_origin_school,
                        'type' => $request->type_origin_school,
                        'npsn' => $request->npsn_origin_school
                    ];

                    OriginSchool::where('id_origin_school', $request->id_origin_school)->update($data);
                    $id_origin_school = $request->id_origin_school;
                }
            } else {
                $id_origin_school = $request->id_origin_school;
            }

            // logic untuk update data orang tua
            if ($student->studentParent == null) {
                $studentParent = 0;
            } else {
                $studentParent = $student->studentParent->id_parent;
            }

            if ($request->id_parent == $studentParent || $request->id_parent == null) {
                // cek dulu apakah request id parent ada dan sudah terdaftar di database
                $existingParent = StudentParent::where('id_parent', '!=', $request->id_parent)->where('father_nik', $request->father_nik)->where('mother_nik', $request->mother_nik)->first();
                if ($existingParent) {
                    $message = "Gagal tambah data orang tua siswa telah terdaftar: " . $request->name . '-> ' . auth()->user()->username;
                    LogHelper::Log($message);
                    return redirect()->back()->with(['flash' => 'errorAddExistingParent']);
                } else if ($request->id_parent == null) {
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
                    $data = [
                        'father_name' => $request->father_name,
                        'father_nik' => $request->father_nik,
                        'father_birth_date' => $request->father_date_birth,
                        'father_birth_place' => $request->father_place_birth,
                        'father_job' => $request->father_job,
                        'father_education' => $request->father_education,
                        'father_income' => $request->father_income,
                        'father_phone' => $request->father_phone,
                        'mother_name' => $request->mother_name,
                        'mother_nik' => $request->mother_nik,
                        'mother_birth_date' => $request->mother_date_birth,
                        'mother_birth_place' => $request->mother_place_birth,
                        'mother_job' => $request->mother_job,
                        'mother_education' => $request->mother_education,
                        'mother_income' => $request->mother_income,
                        'mother_phone' => $request->mother_phone
                    ];
                    StudentParent::where('id_parent', $student->studentParent->id_parent)->update($data);
                    $id_parent = $student->studentParent->id_parent;
                }
            } else {
                $id_parent = $request->id_parent;
            }

            $data = [
                'id_parent' => $id_parent,
                'id_origin_school' => $id_origin_school,
                'id_province' => $request->id_province,
                'id_city' => $request->id_city,
                'id_district' => $request->id_district,
                'id_village' => $request->id_village,
                'nis' => $request->nis,
                'nik' => $request->nik,
                'date_birth' => $request->date_birth,
                'place_birth' => $request->place_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'pos_code' => $request->pos_code,
                'name' => $request->name,
                'status' => $request->status,

            ];

            if ($request->photo != null) {
                $data['photo'] = $request->photo->store('public/pas_foto');
            }

            if ($request->identity != null) {
                $data['identity'] = $request->identity->store('public/identity');
            }

            Student::where('id_student', $student->id_student)->update($data);

            DB::commit();

            $message = "Sukses update data siswa dengan nama: " . $request->name . '-> ' . auth()->user()->username;
            LogHelper::Log($message);

            // calculate percentage completed data
            $totalColumns = env('TOTAL_FIELD_STUDENT');
            $countNotNullColumns = Student::countNotNullColumns($student->id_student);
            $percentageCompleteData = ($countNotNullColumns / $totalColumns) * 100;
            Student::where('id_student', $student->id_student)->update(['completed_field' => $percentageCompleteData]);
            return redirect()->back()->with(['flash' => 'successUpdate']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal update data siswa dengan nama: " . $request->name . '-> ' . auth()->user()->username . 'reason : ' . $th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorAdd']);
        }
    }

    public function deleteStudentAction($id)
    {
        try {
            DB::beginTransaction();

            Student::where('id_student', $id)->delete();
            DB::commit();

            $message = "Sukses hapus data Siswa";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successDelete']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal hapus data Kelas => " . $th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorDelete']);
        }
    }

    public function studentNotHaveClass(Request $request)
    {
        $searchTerm = $request->input('search');

        $parents = Student::where('name', 'LIKE', "%{$searchTerm}%")
            ->get();

        return response()->json($parents);
    }

    public function downloadAction($id)
    {
        // data dasar user
        $student = Student::where('id_student', $id)->first();
        $data = [
            'student' => $student->toArray(), // Konversi model menjadi array
        ];

        // data orang tua
        $parent = $student->studentParent;
        $dataParent = [
            'parent' => $parent->toArray()
        ];
        $data = array_merge($data, $dataParent);

        // data sekolah sebelumnya
        $originSchool = $student->originSchool;
        $dataSchool = [
            'school' => $originSchool->toArray()
        ];
        $data = array_merge($data, $dataSchool);

        // data address
        $address = [
            'address' => [
                'province' => $student->province->name,
                'city' => $student->city->name,
                'district' => $student->district->name,
                'village' => $student->village->name
            ]
        ];
        $data = array_merge($data, $address);
        $path = storage_path('app/' . $student['photo']);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataImage = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataImage);

        $dataImage = [
            'image' => $base64
        ];
        $data = array_merge($data, $dataImage);

        $pdf = PDF::loadView('template.pdf', $data);
        $dateNow = new DateTime();
        $dateString = $dateNow->format('Y-m-d H:i:s');
        $filename = "Data :" . $student->name . "-" . $student->nisn . "-" . $dateString . ".pdf";
        return $pdf->download($filename);
    }

    public function bulkAddStudentAction(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file));
        $header = $data[0];
        unset($data[0]);

        DB::beginTransaction();
        $totalField = env('TOTAL_FIELD_STUDENT');
        try {
            foreach ($data as $row) {
                $student = new Student();
                $student->name = $row[0];
                $student->nik = $row[1];
                $student->nis = $row[2];
                $student->nisn = $row[3];
                $student->place_birth = $row[4];
                $student->date_birth = Carbon::parse($row[5]);
                if ($row[6] == 'Laki-laki' || $row[6] == 'Laki-Laki' || $row[6] == 'LAKI-LAKI' || $row[6] == 'L') {
                    $student->gender = 'L';
                } else if ($row[6] == 'Perempuan' || $row[6] == 'perempuan' || $row[6] == 'PEREMPUAN' || $row[6] == 'P') {
                    $student->gender = 'P';
                }
                $student->address = $row[7];
                $student->completed_field = (9 / $totalField) * 100;
                $student->save();
            }

            DB::commit();
            return redirect()->back()->with('flash', 'successAdd');
        } catch (\Throwable $th) {
            DB::rollBack();
            // Log the exception if needed
            LogHelper::Log('Failed to import students: ' . $th->getMessage());
            return redirect()->back()->with('flash', 'errorAdd');
        }
    }

    public function downloadTemplateAction()
    {
        $filename = "template-data-siswa.csv";
        $filePath = public_path('admin/' . $filename);

        return response()->download($filePath);
    }
}
