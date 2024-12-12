<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolio';

    protected $fillable = [
        'img_path',
        'title',
        'description',
        'service_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
