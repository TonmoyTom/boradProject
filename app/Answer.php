<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
       'qus_id', 'name', 'slug', 'points', 'status', 'approve'
    ];

    public function qustions()
    {
        return $this->belongsTo('App\Qustion', 'qus_id');
    }
}
