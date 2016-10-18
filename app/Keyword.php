<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['word'];

    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }
}
