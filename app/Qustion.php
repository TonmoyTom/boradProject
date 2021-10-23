<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qustion extends Model
{

    protected $fillable = [
        'name', 'slug', 'status', 'approve', 'bg_id', 'sub_id'
    ];


    public function boards()
    {
        return $this->belongsTo('App\Board', 'bd_id');
    }
    public function subjects()
    {
        return $this->belongsTo('App\Subject', 'sub_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer', 'qus_id');
    }
}
