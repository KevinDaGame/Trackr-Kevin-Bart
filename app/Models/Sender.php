<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Sender
 *
 * @property int $id
 * @property int $address_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address|null $address
 * @property-read Collection|Package[] $packages
 * @property-read int|null $packages_count
 * @method static Builder|Sender newModelQuery()
 * @method static Builder|Sender newQuery()
 * @method static Builder|Sender query()
 * @method static Builder|Sender whereAddressId($value)
 * @method static Builder|Sender whereCreatedAt($value)
 * @method static Builder|Sender whereId($value)
 * @method static Builder|Sender whereName($value)
 * @method static Builder|Sender whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Sender extends Model
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
}
