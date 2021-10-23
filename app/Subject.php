<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $fillable = [
        'name', 'slug', 'status', 'approve', 'bg_id'
    ];

    public function backgrounds()
    {
        return $this->belongsTo('App\Background', 'bg_id');
    }

    public function boards()
    {
        return $this->hasMany('App\Board', 'sub_id');
    }

    public function qustions()
    {
        return $this->hasMany('App\Qustion', 'sub_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer', 'qus_id');
    }
}
