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
 * Class ClientEndpoint
 * @package EveScout\Seat\OAuth2Server\Models
 */
class ClientEndpoint extends Model
{
    protected $table = 'oauth_client_endpoints';

    protected $fillable = ['redirect_uri'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}