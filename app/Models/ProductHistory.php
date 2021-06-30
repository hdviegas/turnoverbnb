<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;
    
    protected $fillable = ['product_id', 'qty'];

    protected function serializeDate($date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
