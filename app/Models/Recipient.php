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

    public function scopeFilter($query, array $filters) {
        if ($filters['name'] ?? false) {
            $query
                ->where('first_name' ,'like', '%' . request('name') . '%')
                ->orWhere('middle_name', 'like', '%' . request('name') . '%')
                ->orWhere('last_name', 'like', '%' . request('name') . '%');
        }

        if ($filters['country'] ?? false) {
            $query
                ->whereHas('address', function ($q) {
                    $q->where('country', request('country'));
                });
        }
    }
}
