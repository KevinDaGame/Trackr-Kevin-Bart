<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'address_id', 'recipient_id', 'notes', 'status'];
    public function sender(){
        return $this->belongsTo(Sender::class);
    }

    public function recipient(){
        return $this->belongsTo(Recipient::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function scopeFilter($query, array $filters) {
        if ($filters['sender'] ?? false) {
            $query
                ->whereHas( 'sender', function ($q) {
                    $q->where('name', 'like', '%' . request('sender') . '%');
                });
        }

        if ($filters['receiver'] ?? false) {
            $query
                ->WhereHas('recipient', function ($q) {
                    $q->where('first_name' ,'like', '%' . request('receiver') . '%')
                        ->orWhere('middle_name', 'like', '%' . request('receiver') . '%')
                        ->orWhere('last_name', 'like', '%' . request('receiver') . '%');
                });
        }

        if ($filters['status'] ?? false) {
            $query
                ->Where('status', request('status'));
        }
    }
}
