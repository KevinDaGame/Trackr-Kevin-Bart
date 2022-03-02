<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    use HasFactory;

    public function address(){
        return $this->hasOne(Address::class);
    }
    public function packages(){
        return $this->hasMany(Package::class);
    }
}
