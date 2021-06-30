<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasEvents;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasEvents;

    protected $fillable = ['name', 'price', 'qty'];

    protected function serializeDate($date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function getFillableFields(){        
        return (new static)->getFillable();
    }

    public static function getPrimaryKey(){
        return (new static)->getKeyName();
    }

    public function history()
    {
        return $this->hasMany(ProductHistory::class);
    }

   

}
