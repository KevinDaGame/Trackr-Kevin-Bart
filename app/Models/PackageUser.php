<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{
    use HasFactory;
    protected $fillable = ['package_id', 'user_id'];
    protected $table = 'package_user';
}
