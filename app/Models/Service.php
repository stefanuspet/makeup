<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'price',
    ];

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class, 'service_id');
    }

    public function additionalServices()
    {
        return $this->hasMany(AdditionalService::class, 'service_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
