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
 * Class Session
 * @package EveScout\Seat\OAuth2Server\Models
 */
class Session extends Model
{
    protected $table = 'oauth_sessions';

    public function scopes()
    {
        return $this->hasMany(SessionScope::class);
    }
}