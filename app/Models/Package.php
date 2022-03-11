<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function sender(){
        return $this->belongsTo(Sender::class);
    }

    public function recipient(){
        return $this->belongsTo(Recipient::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function scopeFilter($query) {
        if (request('search')) {
            $query
                ->whereHas( 'sender', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                })
                ->orWhereHas('recipient', function ($r) {
                    $r->where('first_name' ,'like', '%' . request('search') . '%')
                        ->orWhere('middle_name', 'like', '%' . request('search') . '%')
                        ->orWhere('last_name', 'like', '%' . request('search') . '%');
                });
        }
    }
}
