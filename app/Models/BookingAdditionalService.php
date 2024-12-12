<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAdditionalService extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'additional_service_id',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function additionalService()
    {
        return $this->belongsTo(AdditionalService::class);
    }
}
