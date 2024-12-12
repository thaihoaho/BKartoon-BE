<?php

namespace App\Http\Controllers;

use App\Models\FilmDirectory;
use Illuminate\Http\Request;

class FilmDirectoryController extends Controller
{
    // Lấy danh sách tất cả các mục trong bảng
    public function index()
    {
        $directories = FilmDirectory::all();
        return response()->json($directories);
    }

    public function name()
    {
        $names = FilmDirectory::all()->map(function ($dic) {
            return [
                'DIC_ID' => $dic->DIC_ID,
                'Name' => trim(
                    join(' ', array_filter([
                        $dic->FName,
                        $dic->MName,
                        $dic->LName
                    ]))
                ),
            ];
        });
    
        return response()->json($names);
    }
    

    // Lưu một mục mới vào bảng
    public function store(Request $request)
    {
        $validated = $request->validate([
            'DIC_Nationality' => 'required|string|max:255',
            'DIC_YearOfBirth' => 'required|date_format:Y',
            'FName' => 'required|string|max:255',
            'MName' => 'nullable|string|max:255',
            'LName' => 'required|string|max:255',
        ]);

        $directory = FilmDirectory::create($validated);
        return response()->json($directory, 201);
    }

    // Hiển thị thông tin một mục cụ thể
    public function show($id)
    {
        $directory = FilmDirectory::findOrFail($id);
        return response()->json($directory);
    }

    // Cập nhật thông tin một mục
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'DIC_Nationality' => 'sometimes|required|string|max:255',
            'DIC_YearOfBirth' => 'sometimes|required|date_format:Y',
            'FName' => 'sometimes|required|string|max:255',
            'MName' => 'nullable|string|max:255',
            'LName' => 'sometimes|required|string|max:255',
        ]);

        $directory = FilmDirectory::findOrFail($id);
        $directory->update($validated);
        return response()->json($directory);
    }

    // Xóa một mục
    public function destroy($id)
    {
        $directory = FilmDirectory::findOrFail($id);
        $directory->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
