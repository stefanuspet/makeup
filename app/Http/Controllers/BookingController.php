<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingAdditionalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar semua pemesanan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'service'])->get(); // Mengambil semua pemesanan beserta relasi user dan service
        return response()->json([
            'bookings' => $bookings,
            'id' => Auth::id()
        ]); // Mengembalikan daftar pemesanan dalam format JSON
    }

    /**
     * Menyimpan pemesanan baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id', // Memastikan service_id valid
            'date_booking' => 'required|date',
            'total_price' => 'required|numeric',
            'additional_services' => 'array', // Menambahkan validasi untuk layanan tambahan
            'additional_services.*' => 'exists:additional_services,id', // Memastikan setiap layanan tambahan valid
        ]);

        // Menyimpan data pemesanan baru
        $booking = Booking::create([
            'user_id' => Auth::id(), // Menggunakan ID user yang sedang login
            'service_id' => $validated['service_id'],
            'date_booking' => $validated['date_booking'],
            'status' => "pending",
            'total_price' => $validated['total_price'],
        ]);

        // Menyimpan data layanan tambahan yang dipilih
        if (isset($validated['additional_services'])) {
            foreach ($validated['additional_services'] as $additionalServiceId) {
                BookingAdditionalService::create([
                    'booking_id' => $booking->id,
                    'additional_service_id' => $additionalServiceId,
                ]);
            }
        }

        // Mengembalikan response dengan status berhasil dan data pemesanan
        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking
        ], 201);
    }


    /**
     * Menampilkan pemesanan berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::with(['user', 'service'])->find($id); // Mencari pemesanan berdasarkan ID dan relasi dengan user dan service

        // Mengecek apakah pemesanan ditemukan
        if (!$booking) {
            return response()->json([
                'message' => 'Booking not found'
            ], 404);
        }

        return response()->json($booking); // Mengembalikan pemesanan dalam format JSON
    }

    /**
     * Memperbarui pemesanan berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id); // Mencari pemesanan berdasarkan ID

        // Mengecek apakah pemesanan ditemukan
        if (!$booking) {
            return response()->json([
                'message' => 'Booking not found'
            ], 404);
        }

        // Validasi input dari user
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date_booking' => 'required|date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'total_price' => 'required|numeric',
        ]);

        // Memperbarui data pemesanan
        $booking->update([
            'user_id' => $validated['user_id'],
            'service_id' => $validated['service_id'],
            'date_booking' => $validated['date_booking'],
            'status' => $validated['status'],
            'total_price' => $validated['total_price'],
        ]);

        // Mengembalikan response dengan status berhasil dan data pemesanan yang diperbarui
        return response()->json([
            'message' => 'Booking updated successfully',
            'booking' => $booking
        ]);
    }

    /**
     * Menghapus pemesanan berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id); // Mencari pemesanan berdasarkan ID

        // Mengecek apakah pemesanan ditemukan
        if (!$booking) {
            return response()->json([
                'message' => 'Booking not found'
            ], 404);
        }

        // Menghapus pemesanan
        $booking->delete();

        // Mengembalikan response dengan status berhasil
        return response()->json([
            'message' => 'Booking deleted successfully'
        ]);
    }

    // showbooking by user id
    public function userbooking()
    {
        $userid = Auth::id();
        $booking = Booking::with(['user', 'service', "additionalServices"])->where('user_id', $userid)->get(); // Mencari pemesanan berdasarkan ID user dan relasi dengan user dan service

        // Mengecek apakah pemesanan ditemukan
        if (!$booking) {
            return response()->json([
                'message' => 'Booking not found'
            ], 404);
        }

        return response()->json($booking); // Mengembalikan pemesanan dalam format JSON
    }

    public function getAllBooking()
    {
        $bookings = Booking::with(['user', 'service', 'additionalServices', 'paymentProof'])->get(); // Mengambil semua pemesanan beserta relasi user dan service
        return response()->json([
            'bookings' => $bookings,
        ], 200); // Mengembalikan daftar pemesanan dalam format JSON
    }

    public function confirmBooking($id)
    {
        $booking = Booking::find($id); // Mencari pemesanan berdasarkan ID

        // Mengecek apakah pemesanan ditemukan
        if (!$booking) {
            return response()->json([
                'message' => 'Booking not found'
            ], 404);
        }

        $booking->update([
            'status' => 'completed'
        ]);

        return response()->json([
            'message' => 'Booking confirmed successfully',
            'booking' => $booking
        ]);
    }
}
