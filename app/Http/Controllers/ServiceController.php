<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Menampilkan daftar semua layanan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all(); // Mengambil semua layanan dari database
        return response()->json($services); // Mengembalikan daftar layanan dalam format JSON
    }

    /**
     * Menyimpan layanan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        // Menyimpan data layanan baru
        $service = Service::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'price' => $validated['price'],
        ]);

        // Mengembalikan response dengan status berhasil dan data layanan
        return response()->json([
            'message' => 'Service created successfully',
            'service' => $service
        ], 201);
    }

    /**
     * Menampilkan layanan berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::with(['additionalServices', 'portfolio'])
            ->where('id', $id) // Pastikan mengambil layanan yang sesuai dengan ID
            ->first();
        // Mengecek apakah layanan ditemukan
        if (!$service) {
            return response()->json([
                'message' => 'Service not found'
            ], 404);
        }

        return response()->json($service); // Mengembalikan layanan dalam format JSON
    }

    /**
     * Memperbarui layanan berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id); // Mencari layanan berdasarkan ID

        // Mengecek apakah layanan ditemukan
        if (!$service) {
            return response()->json([
                'message' => 'Service not found'
            ], 404);
        }

        // Validasi input dari user
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ]);

        // Memperbarui data layanan
        $service->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'price' => $validated['price'],
        ]);

        // Mengembalikan response dengan status berhasil dan data layanan yang diperbarui
        return response()->json([
            'message' => 'Service updated successfully',
            'service' => $service
        ]);
    }

    /**
     * Menghapus layanan berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id); // Mencari layanan berdasarkan ID

        // Mengecek apakah layanan ditemukan
        if (!$service) {
            return response()->json([
                'message' => 'Service not found'
            ], 404);
        }

        // Menghapus layanan
        $service->delete();

        // Mengembalikan response dengan status berhasil
        return response()->json([
            'message' => 'Service deleted successfully'
        ]);
    }
}
