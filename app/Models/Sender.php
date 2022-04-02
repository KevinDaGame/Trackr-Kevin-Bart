<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sender
 *
 * @property int $id
 * @property int $address_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Package[] $packages
 * @property-read int|null $packages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Sender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sender query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sender whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sender extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function address(){
        return $this->hasOne(Address::class);
    }
    public function packages(){
        return $this->hasMany(Package::class);
    }
}
