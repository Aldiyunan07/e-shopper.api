<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detail(){
        return $this->hasMany(Detail::class);
    }

    public function rupiah($value){
        return "Rp." . number_format($value,2,',','.');
    }

}
