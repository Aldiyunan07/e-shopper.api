<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];
    protected $with = ['product'];
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getGambarAttribute()
    {
        return url('storage/'. $this->photo);
    }
}
