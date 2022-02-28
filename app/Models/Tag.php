<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory,softDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [ 'name'];

    public function mediaTag()
    {
        return $this->hasMany('App\Models\MediaTag','tag_id');
    }

}
