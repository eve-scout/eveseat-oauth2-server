<?php

/*
 * This file is part of OAuth 2.0 Server SeAT Add-on.
 *
 * Copyright (c) 2016 Johnny Splunk <johnnysplunk@eve-scout.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EveScout\Seat\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package EveScout\Seat\OAuth2Server\Models
 */
class Client extends Model
{
    protected $table = 'oauth_clients';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'secret'];

    public function endpoints()
    {
        return $this->hasMany(ClientEndpoint::class);
    }

    public function scopes()
    {
        return $this->belongsToMany(Scope::class, 'oauth_client_scopes')
            ->withTimestamps();
    }
}