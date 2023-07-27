<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $fillable = ['departamento_id', 'name'];

    public function ciudads() {
        return $this->hasMany(Product::class);
    }
}
