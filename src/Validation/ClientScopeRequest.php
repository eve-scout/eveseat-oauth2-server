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
 * Class ClientScopeRequest
 * @package EveScout\Seat\OAuth2Server\Validation
 */
class ClientScopeRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Ensure that the users is set, if not,
        // complain that it is actually required
        if (!$this->request->get('scopes')) {

            $rules['scopes'] = 'required';

            return $rules;

        }

        // Add each user in the multi select dynamically
        foreach ($this->request->get('scopes') as $key => $value)

            $rules['scopes.' . $key] = 'required|exists:oauth_scopes,id';

        return $rules;
    }
}