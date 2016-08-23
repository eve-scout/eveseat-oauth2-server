<?php

/*
 * This file is part of OAuth 2.0 Server SeAT Add-on.
 *
 * Copyright (c) 2016 Johnny Splunk <johnnysplunk@eve-scout.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EveScout\Seat\OAuth2Server\Validation;

use App\Http\Requests\Request;

/**
 * Class ClientRequest
 * @package EveScout\Seat\OAuth2Server\Validation
 */
class ClientRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required|max:255',
            'id'     => 'required|unique:oauth_clients,id|max:255',
            'secret' => 'required|max:255',
        ];
    }
}