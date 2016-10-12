# eveseat-oauth2-server

This [EVE SeAT](https://github.com/eveseat) package enables an OAuth2 server for Single sign-on.

## Install

#### Add Package

Run the following command while in your SeAT install:

```bash
$ composer require eve-scout/eveseat-oauth2-server
```

#### Update Configs

* Open `config/app.php` in your favorite editor.
* Add `EveScout\Seat\OAuth2Server\OAuth2ServerServiceProvider::class` to the bottom of the `providers` array.
* Open `app/Http/Middleware/VerifyCsrfToken.php` in your favorite editor.
* Add `'oauth2/token'` to the bottom of the `$except` array.

#### Package Config Publishing and Migrations

Run the following commands while in your SeAT install:

```bash
$ php artisan vendor:publish
$ php artisan migrate
$ php artisan db:seed --class=EveScout\\Seat\\OAuth2Server\\database\\seeds\\ScopesSeeder
```

## Configuration

* Login to EVE SeAT as an admin.
* Navigate to `OAuth2 Server` > `Clients`.
* Add a new client by giving the client a Name, ID and Secret.
* Add a new client endpoint by navigating to the new client you previously created.
* Add relevant client scopes by navigating to the new client you previously created. For Single sign-on it is suggested that `character.profile`, `character.roles` and `email` are added.

## Credits

  - [Johnny Splunk](http://github.com/johnnysplunk)

## License

[GPL v2 License](https://opensource.org/licenses/GPL-2.0)

Copyright (c) 2016 Johnny Splunk of EVE-Scout <[https://twitter.com/eve_scout](https://twitter.com/eve_scout)>