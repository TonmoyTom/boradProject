<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    protected $fillable = [
        'name', 'slug', 'status', 'approve'
    ];

    public function subjects()
    {
        return $this->hasMany('App\Subject', 'bg_id', 'id');
    }
}
