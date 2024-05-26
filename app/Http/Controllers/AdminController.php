<?php

namespace App\Http\Controllers;

use App\Http\Helpers\LogHelper;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // count data siswa
        $studentCount = Student::count();
        $dominanGender = "Seimbang";

        // count gender from data
        $male = Student::where('gender', 'L')->count();
        $female = Student::where('gender', 'P')->count();
        if ($male > $female) {
            $dominanGender = "Laki-laki";
        } else if ($male < $female) {
            $dominanGender = "Perempuan";
        }

        // count data origin school
        $mtsCount = Student::join('origin_schools', 'students.id_origin_school', '=', 'origin_schools.id_origin_school')
            ->where('origin_schools.type', env('TYPE_SCHOOL_MTS'))
            ->count();
        $pkbmCount = Student::join('origin_schools', 'students.id_origin_school', '=', 'origin_schools.id_origin_school')
            ->where('origin_schools.type', env('TYPE_SCHOOL_PKBM'))
            ->count();
        $pondokCount = Student::join('origin_schools', 'students.id_origin_school', '=', 'origin_schools.id_origin_school')
            ->where('origin_schools.type', env('TYPE_SCHOOL_PONDOK_PESANTREN'))
            ->count();
        $negeriSwastaCount = Student::join('origin_schools', 'students.id_origin_school', '=', 'origin_schools.id_origin_school')
            ->where('origin_schools.type', env('TYPE_SCHOOL_SMP_NEGERI_SWASTA'))
            ->count();
        $originSchoolCounts = [
            env('TYPE_SCHOOL_MTS') => $mtsCount,
            env('TYPE_SCHOOL_PKBM') => $pkbmCount,
            env('TYPE_SCHOOL_PONDOK_PESANTREN') => $pondokCount,
            env('TYPE_SCHOOL_SMP_NEGERI_SWASTA') => $negeriSwastaCount,
        ];
        $dominanTypeOriginSchool = array_keys($originSchoolCounts, max($originSchoolCounts))[0];
        $originSchoolTypes = [
            'series' => array_values($originSchoolCounts),
            'labels' => array_keys($originSchoolCounts),
            'dominanTypeOriginSchool' => $dominanTypeOriginSchool,
        ];

        // count data income father
        $fatherUnder500 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.father_income', env('RANGE_INCOME_UNDER_500'))
            ->count();
        $fatherBetween500_1 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.father_income', env('RANGE_INCOME_BETWEEN_500_1'))
            ->count();
        $fatherBetween1_2 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.father_income', env('RANGE_INCOME_BETWEEN_1_2'))
            ->count();
        $fatherBetween3_5 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.father_income', env('RANGE_INCOME_BETWEEN_3_5'))
            ->count();
        $fatherMoreThen3_5 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.father_income', env('RANGE_INCOME_MORE_THEN_5'))
            ->count();
        
        $fatherIncomes = [
            env('RANGE_INCOME_UNDER_500') => $fatherUnder500,
            env('RANGE_INCOME_BETWEEN_500_1') => $fatherBetween500_1,
            env('RANGE_INCOME_BETWEEN_1_2') => $fatherBetween1_2,
            env('RANGE_INCOME_BETWEEN_3_5') => $fatherBetween3_5,
            env('RANGE_INCOME_MORE_THEN_5') => $fatherMoreThen3_5,
        ];
        $dominanFatherIncome = array_keys($fatherIncomes, max($fatherIncomes))[0];
        $fatherIncomes = [
            'series' => array_values($fatherIncomes),
            'labels' => array_keys($fatherIncomes),
            'dominanFatherIncome' => $dominanFatherIncome,
        ];

        // count data income mother
        $motherUnder500 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.mother_income', env('RANGE_INCOME_UNDER_500'))
            ->count();
        $motherBetween500_1 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.mother_income', env('RANGE_INCOME_BETWEEN_500_1'))
            ->count();
        $motherBetween1_2 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.mother_income', env('RANGE_INCOME_BETWEEN_1_2'))
            ->count();
        $motherBetween3_5 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.mother_income', env('RANGE_INCOME_BETWEEN_3_5'))
            ->count();
        $motherMoreThen3_5 = Student::join('parents', 'students.id_parent', '=', 'parents.id_parent')
            ->where('parents.mother_income', env('RANGE_INCOME_MORE_THEN_5'))
            ->count();
        
        $motherIncomes = [
            env('RANGE_INCOME_UNDER_500') => $motherUnder500,
            env('RANGE_INCOME_BETWEEN_500_1') => $motherBetween500_1,
            env('RANGE_INCOME_BETWEEN_1_2') => $motherBetween1_2,
            env('RANGE_INCOME_BETWEEN_3_5') => $motherBetween3_5,
            env('RANGE_INCOME_MORE_THEN_5') => $motherMoreThen3_5,
        ];
        $dominanMotherIncome = array_keys($motherIncomes, max($motherIncomes))[0];
        $motherIncomes = [
            'series' => array_values($motherIncomes),
            'labels' => array_keys($motherIncomes),
            'dominanMotherIncome' => $dominanMotherIncome,
        ];


        $data = [
            "student" => $studentCount,
            "gender" => [
                "series" => [$male, $female],
                "labels" => ['Laki-laki', 'Perempuan'],
                "dominanGender" => $dominanGender
            ],
            "originSchoolType" => $originSchoolTypes,
            "fatherIncome" => $fatherIncomes,
            "motherIncome" => $motherIncomes
        ];

        return view('admin.dashboard', compact('data'));
    }

    public function updateProfileAction(Request $request)
    {
        try {
            $dataPassword = [];
            if ($request->password || $request->re_password) {
                if ($request->password != $request->re_password) {
                    return redirect()->back()->with(['flash' => 'passwordNotMatch']);
                }
    
                if (strlen($request->password) < 8) {
                    return redirect()->back()->with(['flash' => 'passwordMin8Char']);
                }
    
                if (strpos($request->password, ' ') !== false) {
                    return redirect()->back()->with(['flash' => 'passwordHaveSpace']);
                }

                $dataPassword = [
                    'password' => Hash::make($request->password)
                ];
            }

            if (strpos($request->username, ' ') !== false) {
                return redirect()->back()->with(['flash' => 'usernameHaveSpace']);
            }

            $existingUser = User::where('username', $request->username)->where('id', '!=', auth()->user()->id)->count();
            if ($existingUser > 0) {
                return redirect()->back()->with(['flash' => 'userAlreadyRegister']);
            }

            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'role' => $request->role 
            ];
            $finalData = array_merge($data, $dataPassword);

            User::where('id', auth()->user()->id)->update($finalData);

            DB::commit();

            $message = "Sukses update data user";
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'successUpdate']);
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = "Gagal update data user" . $th;
            LogHelper::Log($message);
            return redirect()->back()->with(['flash' => 'errorUpdate']);
        }
    }
}
