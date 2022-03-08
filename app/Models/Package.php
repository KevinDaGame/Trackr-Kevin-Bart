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
}
