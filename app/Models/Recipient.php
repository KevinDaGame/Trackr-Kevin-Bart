<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address|null $address
 * @property-read Collection|Package[] $packages
 * @property-read int|null $packages_count
 * @method static Builder|Recipient newModelQuery()
 * @method static Builder|Recipient newQuery()
 * @method static Builder|Recipient query()
 * @method static Builder|Recipient whereAddressId($value)
 * @method static Builder|Recipient whereCreatedAt($value)
 * @method static Builder|Recipient whereEmailAddress($value)
 * @method static Builder|Recipient whereFirstName($value)
 * @method static Builder|Recipient whereId($value)
 * @method static Builder|Recipient whereLastName($value)
 * @method static Builder|Recipient whereMiddleName($value)
 * @method static Builder|Recipient wherePhoneNumber($value)
 * @method static Builder|Recipient whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|Recipient filter(array $filters)
 */
class Recipient extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function fullName(): string
    {
        $fullName = $this->first_name . ' ';

        if ($this->middle_name != null) {
            $fullName .= $this->middle_name . ' ';
        }
        return $fullName . $this->last_name;
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['name'] ?? false) {
            $query
                ->where('name', 'like', '%' . request('name') . '%');
        }

        if ($filters['country'] ?? false) {
            $query
                ->whereHas('address', function ($q) {
                    $q->where('country', request('country'));
                });
        }
    }
}
