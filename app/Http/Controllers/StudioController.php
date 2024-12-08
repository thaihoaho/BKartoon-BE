<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::all();
        return response()->json($studios);
    }
    public function name()
    {
        $names = Studio::pluck('STU_Name');

        return response()->json($names);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'STU_Name' => 'required|string|max:255',
        ]);

        $studio = Studio::create([
            'STU_Name' => $request->STU_Name,
        ]);

        return response()->json($studio, 201);
    }

    // Cập nhật thông tin studio
    public function update(Request $request, $id)
    {
        $request->validate([
            'STU_Name' => 'required|string|max:255',
        ]);

        $studio = Studio::findOrFail($id);
        $studio->update([
            'STU_Name' => $request->STU_Name,
        ]);

        return response()->json($studio);
    }

    // Xóa một studio
    public function destroy($id)
    {
        $studio = Studio::findOrFail($id);
        $studio->delete();

        return response()->json(['message' => 'Studio deleted successfully']);
    }
}
