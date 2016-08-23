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
use EveScout\Seat\OAuth2Server\Models\ClientEndpoint;

use EveScout\Seat\OAuth2Server\Validation\ClientEndpointRequest;

/**
 * Class ClientEndpointsController
 * @package EveScout\Seat\OAuth2Server\Http\Controllers\Admin
 */
class ClientEndpointsController extends Controller
{
    public function store($client, ClientEndpointRequest $request)
    {
        $client = Client::find($client);
        
        if ($client->endpoints->contains('redirect_uri', $request->redirect_uri)) {
            return redirect()->back()
                ->with('error', 'Endpoint already exists.');
        }

        $client->endpoints()->create($request->all());

        return redirect()->back()
            ->with('success', 'Endpoint added.');
    }

    public function destroy($client, $endpoint)
    {
        $endpoint = ClientEndpoint::find($endpoint);
        $endpoint->delete();

        return redirect()->back()
            ->with('success', 'Endpoint deleted.');
    }
}