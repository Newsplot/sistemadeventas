<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'name', 'lastname', 'identification', 'phone', 'address'];


    public function city() {
        return $this->belongsTo(City::class);
    }
}
