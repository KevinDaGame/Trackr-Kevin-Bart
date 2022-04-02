<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
/**
 * App\Models\Package
 *
 * @property int $id
 * @property int $sender_id
 * @property int|null $recipient_id
 * @property int $address_id
 * @property string|null $notes
 * @property string|null $sent_date
 * @property string|null $delivered_date
 * @property \App\Models\Status|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \App\Models\Recipient|null $recipient
 * @property-read \App\Models\Sender|null $sender
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDeliveredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereRecipientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereSentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Package extends Model
{
    use HasFactory;
    use Uuid;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
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
