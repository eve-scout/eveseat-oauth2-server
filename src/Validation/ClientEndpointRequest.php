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
 * Class ClientEndpointRequest
 * @package EveScout\Seat\OAuth2Server\Validation
 */
class ClientEndpointRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'redirect_uri'   => 'required|url'
        ];
    }
}