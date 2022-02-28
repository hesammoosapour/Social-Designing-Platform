<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Customer extends Model
{
    use HasFactory,HasRoles, softDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['designer_id','username', 'password',];
}

