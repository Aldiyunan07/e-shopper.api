<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $with = ['user','brand','type'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail(){
        return $this->hasMany(Detail::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function rupiah($value){
        return "Rp." . number_format($value,2,',','.');
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
