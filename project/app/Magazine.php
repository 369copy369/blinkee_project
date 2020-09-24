<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'publisher_id'
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'publisher_id' => 'integer'
    ];



    /**
     * Get the publisher that owns a magazine.
     */
    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }
}
