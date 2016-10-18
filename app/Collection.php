<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function keywords()
    {
        return $this->hasMany('App\Keyword');
    }
}
