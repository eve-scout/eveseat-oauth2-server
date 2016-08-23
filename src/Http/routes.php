<?php

/*
 * This file is part of OAuth 2.0 Server SeAT Add-on.
 *
 * Copyright (c) 2016 Johnny Splunk <johnnysplunk@eve-scout.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group([
    'namespace' => 'EveScout\Seat\OAuth2Server\Http\Controllers',
], function () {

    Route::group(['prefix' => 'oauth2', 'as' => 'oauth2.'], function() {
        Route::group(['middleware' => ['check-authorization-params', 'auth']], function() {
            Route::get('/authorize', [
                'as'         => 'authorize.get',
                'uses'       => 'OAuth2ServerController@getAuthorize'
            ]);

            Route::post('/authorize', [
                'as'         => 'authorize.post',
                'uses'       => 'OAuth2ServerController@postAuthorize'
            ]);

            Route::get('/character-chooser', [
                'as'         => 'character-chooser.get',
                'uses'       => 'OAuth2ServerController@getCharacterChooser'
            ]);

            Route::post('/character-chooser', [
                'as'         => 'character-chooser.post',
                'uses'       => 'OAuth2ServerController@postCharacterChooser'
            ]);
        });

        Route::post('/token', [
            'as'         => 'token.post',
            'middleware' => [],
            'uses'       => 'OAuth2ServerController@postToken'
        ]);

        Route::get('/profile', [
            'as'     => 'profile.get',
            'middleware' => ['oauth:character.profile'],
            'uses'   => 'OAuth2ServerController@getProfile'
        ]);
    });

    Route::group([
        'namespace'  => 'Admin',
        'middleware' => 'bouncer:superuser',
        'prefix'     => 'oauth2-admin'
    ], function () {

        Route::resource('clients', 'ClientsController');

        Route::resource('clients.endpoints', 'ClientEndpointsController',
            ['only' => ['store', 'destroy']]);

        Route::resource('clients.scopes', 'ClientScopesController',
            ['only' => ['store', 'destroy']]);
    });

});