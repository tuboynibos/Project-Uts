<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Alumni;

class AlumniController extends Controller
{
    public function index()
    {
        // Mengambil semua data alumni menggunakan Eloquent
        $alumni = Alumni::all();

        // Cek apakah data alumni kosong atau tidak
        if ($alumni->isEmpty()) {
            // Jika kosong, berikan response dengan pesan "Data is empty"
            return response()->json([
                'message' => 'Data is empty'
            ], 200);
        }

        // Jika ada data, berikan response dengan data alumni
        return response()->json([
            'message' => 'Get All Resource',
            'data' => $alumni
        ], 200);
    }
    public function store(Request $request)
    {
        // Validasi input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'graduation_year' => 'required|integer',
            'status' => 'required|string',
            'company_name' => 'nullable|string',
            'position' => 'nullable|string'
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Menyimpan data baru
        $alumni = Alumni::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'graduation_year' => $request->graduation_year,
            'status' => $request->status,
            'company_name' => $request->company_name,
            'position' => $request->position,
        ]);

        // Response jika data berhasil ditambahkan
        return response()->json([
            'message' => 'Resource is added successfully',
            'data' => $alumni
        ], 201);
    }

    public function show($id)
    {
        // Use Eloquent's find method to retrieve the resource
        $alumni = Alumni::find($id);

        // Check if the resource exists
        if ($alumni) {
            return response()->json([
                'message' => 'Get Detail Resource',
                'data' => $alumni,
                'kode_status' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Resource not found',
                'kode_status' => 404
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        // Gunakan metode find Eloquent untuk mendapatkan resource
        $alumni = Alumni::find($id);

        // Periksa apakah resource ada
        if ($alumni) {
            // Memperbarui resource dengan data parsial
            $alumni->update($request->all());

            return response()->json([
                'message' => 'Resource is update successfully',
                'data' => $alumni,
                'kode_status' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Resource not found',
                'kode_status' => 404
            ], 404);
        }
    }
    
    public function destroy($id)
    {
        // Gunakan metode find Eloquent untuk mendapatkan resource
        $alumni = Alumni::find($id);

        // Periksa apakah resource ada
        if ($alumni) {
            // Hapus resource
            $alumni->delete();

            return response()->json([
                'message' => 'Resource is delete successfully',
                'kode_status' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Resource not found',
                'kode_status' => 404
            ], 404);
        }
    }

    public function searchByName(Request $request)
    {
        $name = $request->input('name');
        
        // Cari resource berdasarkan nama menggunakan Eloquent
        $alumni = Alumni::where('name', 'LIKE', "%$name%")->get();

        if ($alumni->isEmpty()) {
            return response()->json([
                'message' => 'Resource not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Get searched resource',
            'data' => $alumni,
        ], 200);
    }

    public function getFreshGraduates()
    {
        // Mendapatkan resource yang baru lulus menggunakan Eloquent
        $freshGraduates = Alumni::where('status', 'fresh graduate')->get();

        return response()->json([
            'message' => 'Get fresh graduate resource',
            'total' => $freshGraduates->count(),
            'data' => $freshGraduates,
        ], 200);
    }

    public function getEmployedResources()
    {
        // Mendapatkan resource yang sudah bekerja menggunakan Eloquent
        $employedAlumni = Alumni::where('status', 'employed')->get();

        return response()->json([
            'message' => 'Get employed resource',
            'total' => $employedAlumni->count(),
            'data' => $employedAlumni,
        ], 200);
    }

    public function getUnemployedResource()
    {
        // Mendapatkan semua resource yang belum bekerja
        $unemployedResources = Alumni::where('status', 'unemployed')->get();

        // Membuat response
        return response()->json([
            'message' => 'Get unemployed resource',
            'total' => $unemployedResources->count(),
            'data' => $unemployedResources,
            'status' => 200
        ], 200);
    }

}
