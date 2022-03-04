<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;


    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function packages(){
        return $this->hasMany(Package::class);
    }
    public function fullName(): string
    {
        $fullName = $this->first_name . ' ';

        if($this->middle_name != null) {
            $fullName .= $this->middle_name . ' ';
        }
        return $fullName . $this->last_name;
    }
}
