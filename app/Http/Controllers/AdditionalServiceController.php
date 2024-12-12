<?php

namespace App\Http\Controllers;

use App\Models\AdditionalService;
use Illuminate\Http\Request;

class AdditionalServiceController extends Controller
{
    /**
     * Menampilkan daftar semua layanan tambahan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additionalServices = AdditionalService::all(); // Mengambil semua layanan tambahan dari database
        return response()->json($additionalServices); // Mengembalikan daftar layanan tambahan dalam format JSON
    }

    /**
     * Menyimpan layanan tambahan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'service_id' => 'required|exists:services,id', // Memastikan service_id valid
        ]);

        // Menyimpan data layanan tambahan baru
        $additionalService = AdditionalService::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'service_id' => $validated['service_id'],
        ]);

        // Mengembalikan response dengan status berhasil dan data layanan tambahan
        return response()->json([
            'message' => 'Additional service created successfully',
            'additional_service' => $additionalService
        ], 201);
    }

    /**
     * Menampilkan layanan tambahan berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $additionalService = AdditionalService::find($id); // Mencari layanan tambahan berdasarkan ID

        // Mengecek apakah layanan tambahan ditemukan
        if (!$additionalService) {
            return response()->json([
                'message' => 'Additional service not found'
            ], 404);
        }

        return response()->json($additionalService); // Mengembalikan layanan tambahan dalam format JSON
    }

    /**
     * Memperbarui layanan tambahan berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $additionalService = AdditionalService::find($id); // Mencari layanan tambahan berdasarkan ID

        // Mengecek apakah layanan tambahan ditemukan
        if (!$additionalService) {
            return response()->json([
                'message' => 'Additional service not found'
            ], 404);
        }

        // Validasi input dari user
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'service_id' => 'required|exists:services,id',
        ]);

        // Memperbarui data layanan tambahan
        $additionalService->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'service_id' => $validated['service_id'],
        ]);

        // Mengembalikan response dengan status berhasil dan data layanan tambahan yang diperbarui
        return response()->json([
            'message' => 'Additional service updated successfully',
            'additional_service' => $additionalService
        ]);
    }

    /**
     * Menghapus layanan tambahan berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $additionalService = AdditionalService::find($id); // Mencari layanan tambahan berdasarkan ID

        // Mengecek apakah layanan tambahan ditemukan
        if (!$additionalService) {
            return response()->json([
                'message' => 'Additional service not found'
            ], 404);
        }

        // Menghapus layanan tambahan
        $additionalService->delete();

        // Mengembalikan response dengan status berhasil
        return response()->json([
            'message' => 'Additional service deleted successfully'
        ]);
    }
}
