<?php

/*
 * This file is part of OAuth 2.0 Server SeAT Add-on.
 *
 * Copyright (c) 2016 Johnny Splunk <johnnysplunk@eve-scout.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EveScout\Seat\OAuth2Server\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use EveScout\Seat\OAuth2Server\Models\Client;
use EveScout\Seat\OAuth2Server\Models\ClientScope;
use EveScout\Seat\OAuth2Server\Models\Scope;

use EveScout\Seat\OAuth2Server\Validation\ClientScopeRequest;

/**
 * Class ClientScopesController
 * @package EveScout\Seat\OAuth2Server\Http\Controllers\Admin
 */
class ClientScopesController extends Controller
{
    public function store($client, ClientScopeRequest $request)
    {
        $client = Client::find($client);

        foreach ($request->scopes as $key => $scope) {
            if (! $client->scopes->contains('id', $scope)) {
                $client->scopes()->attach($scope);
            }
        }

        return redirect()->back()
            ->with('success', 'Scopes Added to Client');
    }

    public function destroy($client, $scope)
    {
        $client = Client::find($client);

        $client->scopes()->detach($scope);

        return redirect()->back()
            ->with('success', 'Scope Removed from Client');
    }
}