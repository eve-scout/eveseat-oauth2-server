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

use Authorizer;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Route;
use Seat\Services\Repositories\Configuration\UserRespository;
use Seat\Services\Repositories\Character\CharacterRepository;
use Seat\Eveapi\Models\Eve\ApiKey as ApiKeyModel;

use Seat\Web\Models\Acl\Affiliation;
use Seat\Web\Models\Acl\Role;

use EveScout\Seat\OAuth2Server\Models\Client;
use EveScout\Seat\OAuth2Server\Models\Scope;

use EveScout\Seat\OAuth2Server\Validation\ClientRequest;

/**
 * Class ClientsController
 * @package EveScout\Seat\OAuth2Server\Http\Controllers\Admin
 */
class ClientsController extends Controller
{
    private function isVerifyCsrfTokenExceptValid() {
        // Reflect the class and get default properies
        $middlewareReflector = new \ReflectionClass(\App\Http\Middleware\VerifyCsrfToken::class);
        $properties = $middlewareReflector->getDefaultProperties();

        // If except property not found
        if (! isset($properties['except'])) {
            return FALSE;
        }

        // Get the property and check for the route
        $csrfExceptProperty = $properties['except'];
    
        if (! in_array('oauth2/token', $csrfExceptProperty)) {
            return FALSE;
        }

        return TRUE;
    }

    public function index(Request $request)
    {
        // Check Csrf exception settings and display an error prompt.
        if (! $this->isVerifyCsrfTokenExceptValid()) {
            $request->session()->flash('error', 'OAuth2 will not work until you add \'oauth2/token\' to the \'$except\' property in /app/Http/Middleware/VerifyCsrfToken.php');
        }

        $clients = Client::all();

        return view('oauth2::admin.clients.index', compact('clients'));
    }

    public function show($client) {
        $client = Client::findOrFail($client);
        $availableScopes = Scope::all();

        return view('oauth2::admin.clients.show', compact(['client', 'availableScopes']));
    }

    public function store(ClientRequest $request)
    {
        $client = Client::create($request->all());

        return redirect()->route('oauth2-admin.clients.show', [$client->id])
            ->with('success', 'New Client Created');
    }

    public function update($client, ClientRequest $request)
    {
        $client = Client::findOrFail($client);
        $client->update($request->all());

        return redirect()->back()
            ->with('success', 'Oauth2 Client Updated');
    }

    public function destroy($client)
    {
        $client = Client::findOrFail($client);
        $client->delete();

        return redirect()->back()
            ->with('success', 'Oauth2 Client Deleted');
    }
}