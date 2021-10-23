<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'name', 'slug', 'point', 'status', 'approve'
    ];

    public function qustions()
    {
        return $this->belongsTo('App\Qustion', 'qus_id');
    }
}
