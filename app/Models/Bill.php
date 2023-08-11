<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'employee_id', 'product_id','subtotal', 'total'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
