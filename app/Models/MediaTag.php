<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaTag extends Model
{
    use HasFactory,softDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['tag_id', 'media_id'];

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

}
