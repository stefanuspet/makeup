<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'file_path',
        'uploaded_at',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
