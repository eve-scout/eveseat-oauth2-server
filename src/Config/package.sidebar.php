<?php

/*
 * This file is part of OAuth 2.0 Server SeAT Add-on.
 *
 * (c) Johnny Splunk <johnnysplunk@eve-scout.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
	'oath2server' => [
        'permission'    => 'Superuser',
        'name'          => 'OAuth2 Server',
        'icon'          => 'fa-lock',
        'route_segment' => 'oauth2-admin',
        'entries'       => [
                [
                    'name'  => 'Clients',
                    'icon'  => 'fa-list',
                    'route' => 'oauth2-admin.clients.index'
                ]
            ]
    ]
];
