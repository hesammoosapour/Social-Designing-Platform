<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id' ,
        'model_type',
        'model_id' ,
    ];

    public function modelable()
    {
        return $this->morphTo(__FUNCTION__,'model_type','model_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function likeable()
    {
        return $this->morphTo();
    }

}
