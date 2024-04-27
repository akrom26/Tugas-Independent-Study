<?php

namespace App\Http\Controllers;

use App\Models\StudentParent;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function searchParent(Request $request)
    {
        $searchTerm = $request->input('searchParent');

        $parents = StudentParent::where('father_nik', 'LIKE', "%{$searchTerm}%")
            ->get();

        return response()->json($parents);
    }
}
