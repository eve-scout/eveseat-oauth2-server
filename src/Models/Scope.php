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
 * Class Scope
 * @package EveScout\Seat\OAuth2Server\Models
 */
class Scope extends Model
{
    protected $table = 'oauth_scopes';

    protected $fillable = ['id', 'description'];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'oauth_client_scopes')
            ->withTimestamps();
    }
}