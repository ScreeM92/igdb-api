<?php

namespace App\Models;

class Game extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The roles that belong to the user.
     */
    // public function category()
    // {
    //     return $this->belongsToMany('App\Models\Category', 'game_category', 'game_id', 'category_id');
    //     // return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    // }
}