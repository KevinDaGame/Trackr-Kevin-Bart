<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recipient
 *
 * @property int $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email_address
 * @property string $phone_number
 * @property int $address_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Package[] $packages
 * @property-read int|null $packages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereEmailAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recipient extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];


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
