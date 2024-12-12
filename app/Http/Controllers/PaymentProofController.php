<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PaymentProof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentProofController extends Controller
{
    /**
     * Menampilkan semua bukti pembayaran.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentProofs = PaymentProof::with('booking')->get(); // Mengambil semua bukti pembayaran dengan relasi ke booking
        return response()->json($paymentProofs); // Mengembalikan daftar bukti pembayaran dalam format JSON
    }

    /**
     * Menyimpan bukti pembayaran baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // Memastikan booking_id valid
            'file' => 'required|file|mimes:jpg,png,pdf|max:10240', // Validasi file gambar atau pdf
        ]);

        // Mendapatkan booking terkait
        $booking = Booking::find($validated['booking_id']);
        $booking->status = 'confirmed';
        $booking->save();

        // Menyimpan file bukti pembayaran ke storage
        $path = $request->file('file')->store('payment_proofs', 'public');

        // Membuat entri bukti pembayaran baru di database
        $paymentProof = PaymentProof::create([
            'booking_id' => $validated['booking_id'],
            'file_path' => $path,
            'uploaded_at' => now(),
        ]);

        return response()->json([
            'message' => 'Payment proof uploaded successfully',
            'payment_proof' => $paymentProof
        ], 201);
    }

    /**
     * Menampilkan bukti pembayaran berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentProof = PaymentProof::with('booking')->find($id); // Mencari bukti pembayaran berdasarkan ID

        // Mengecek apakah bukti pembayaran ditemukan
        if (!$paymentProof) {
            return response()->json([
                'message' => 'Payment proof not found'
            ], 404);
        }

        return response()->json($paymentProof); // Mengembalikan bukti pembayaran dalam format JSON
    }

    /**
     * Memperbarui bukti pembayaran.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paymentProof = PaymentProof::find($id); // Mencari bukti pembayaran berdasarkan ID

        // Mengecek apakah bukti pembayaran ditemukan
        if (!$paymentProof) {
            return response()->json([
                'message' => 'Payment proof not found'
            ], 404);
        }

        // Validasi input
        $validated = $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:10240', // Validasi file gambar atau pdf
        ]);

        // Menghapus file lama jika ada
        if ($paymentProof->file_path && Storage::exists('public/' . $paymentProof->file_path)) {
            Storage::delete('public/' . $paymentProof->file_path);
        }

        // Menyimpan file bukti pembayaran baru
        $path = $request->file('file')->store('payment_proofs', 'public');

        // Memperbarui entri bukti pembayaran
        $paymentProof->update([
            'file_path' => $path,
            'uploaded_at' => now(),
        ]);

        return response()->json([
            'message' => 'Payment proof updated successfully',
            'payment_proof' => $paymentProof
        ]);
    }

    /**
     * Menghapus bukti pembayaran.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentProof = PaymentProof::find($id); // Mencari bukti pembayaran berdasarkan ID

        // Mengecek apakah bukti pembayaran ditemukan
        if (!$paymentProof) {
            return response()->json([
                'message' => 'Payment proof not found'
            ], 404);
        }

        // Menghapus file bukti pembayaran dari storage
        if (Storage::exists('public/' . $paymentProof->file_path)) {
            Storage::delete('public/' . $paymentProof->file_path);
        }

        // Menghapus entri bukti pembayaran dari database
        $paymentProof->delete();

        return response()->json([
            'message' => 'Payment proof deleted successfully'
        ]);
    }
}
