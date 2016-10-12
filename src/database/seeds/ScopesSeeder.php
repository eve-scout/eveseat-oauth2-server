<?php

/*
 * This file is part of OAuth 2.0 Server SeAT Add-on.
 *
 * (c) Johnny Splunk <johnnysplunk@eve-scout.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EveScout\Seat\OAuth2Server\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScopesSeeder extends Seeder
{

    protected $scopes = [

        [ // character.profile scope
            'id'          => 'character.profile',
            'description' => 'View character public information.'
        ],
        [   // character.roles scope
            'id'          => 'character.roles',
            'description' => 'View roles assigned to character to grant access to application features.'
        ],
        [   // email scope
            'id'          => 'email',
            'description' => 'View email address used for the authorization service.'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Check if we have the scopes, else,
        // insert them
        foreach ($this->scopes as $scope) {

            $existing = DB::table('oauth_scopes')
                ->where('id', $scope['id'])
                ->first();

            if (!$existing) {
                $scope['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
                $scope['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');

                DB::table('oauth_scopes')->insert($scope);
            }
        }
    }
}
