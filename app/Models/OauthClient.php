<?php

namespace App\Models;

class OauthClient extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oauth_clients';

    public function user()
    {
        return $this->belongsToOne('App\Models\User', 'user_id', 'id');
    }
}