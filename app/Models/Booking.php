<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'date_booking',
        'status',
        'total_price',
        'alamat',
        'waktu',
        'acara',
        'hijabdo_hairdo',
        'jumlah_orang',
        'no_telp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function additionalServices()
    {
        return $this->belongsToMany(AdditionalService::class, 'booking_additional_services');
    }

    public function paymentProof()
    {
        return $this->hasOne(PaymentProof::class);
    }
}
