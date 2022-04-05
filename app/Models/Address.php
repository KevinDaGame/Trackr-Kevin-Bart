<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Address
 *
 * @property int $id
 * @property string $street
 * @property int $house_number
 * @property string|null $addition
 * @property string $city
 * @property string $postal_code
 * @property string $country
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Address newModelQuery()
 * @method static Builder|Address newQuery()
 * @method static Builder|Address query()
 * @method static Builder|Address whereAddition($value)
 * @method static Builder|Address whereCity($value)
 * @method static Builder|Address whereCountry($value)
 * @method static Builder|Address whereCreatedAt($value)
 * @method static Builder|Address whereHouseNumber($value)
 * @method static Builder|Address whereId($value)
 * @method static Builder|Address wherePostalCode($value)
 * @method static Builder|Address whereStreet($value)
 * @method static Builder|Address whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Address extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    use HasFactory;

    protected function postalCode(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtoupper(str_replace(' ', '', $value)),
        );
    }
}
