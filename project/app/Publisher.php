<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];



    /**
     * Get magazines which belong to publisher.
     */
    public function magazines()
    {
        return $this->hasMany('App\Magazine');
    }
}
