<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    protected $fillable = [
        'name', 'slug', 'status', 'approve', 'sub_id'
    ];

    public function subjects()
    {
        return $this->belongsTo('App\Subject', 'sub_id');
    }

    public function qustions()
    {
        return $this->hasMany('App\Qustion', 'bd_id');
    }
}
