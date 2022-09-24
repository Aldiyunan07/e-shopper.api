<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function getGambarAttribute()
    {
        return url('storage/'. $this->photo);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
