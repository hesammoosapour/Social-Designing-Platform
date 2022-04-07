<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory,softDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['privacy'];

    public function modelable()
    {
        return $this->morphTo();
    }

//    public function user()
//    {
//        $this->belongsTo('App\Models\User','id','model_id');
//    }


}
