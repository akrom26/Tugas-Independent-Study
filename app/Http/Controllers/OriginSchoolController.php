<?php

namespace App\Http\Controllers;

use App\Models\OriginSchool;
use Illuminate\Http\Request;

class OriginSchoolController extends Controller
{
    public function searchOriginSchool(Request $request)
    {
        $searchTerm = $request->input('searchOriginSchool');

        $parents = OriginSchool::where('npsn', 'LIKE', "%{$searchTerm}%")
            ->orWhere('name', 'LIKE', "%{$searchTerm}%")
            ->get();

        return response()->json($parents);
    }

    public function detailOriginSchool(Request $request)
    {
        $id = $request->input('id');
        $parent = OriginSchool::where('id_origin_school', $id)->first();

        return response()->json($parent);
    }
}
