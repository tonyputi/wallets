# Run it once assignment test

## Preface

The purpose of the assignement is to create a bunch of api to manage the player wallets and a frontend
application that will consume that apis. More info can be found [here](./assignment-202107.docx)

I know that it is possible to use custom authentication solution but why we have to reinvent the wheel when `Laravel` 
is already providing many ways to authenticate a user via SPA and consume REST APIs safely? So I decided to use 
`Laravel Sancutm` rather than `Laravel Passport` and make use of `axios` library as well to consume the APIs from the 
frontend application. I've also chosen to use my own custom docker image rather than `Laravel Sail`. The purpose to use 
custom docker image and configuration is just to show the level experience with `Docker` as well.

The application is making use the following `Laravel` features

- [Sanctum](https://laravel.com/docs/8.x/sanctum) to authenticate api calls;
- [Policies](https://laravel.com/docs/8.x/authorization) to authorize user abilities;
- [Form Requests](https://laravel.com/docs/8.x/validation#form-request-validation) to validate requests;
- [Observers](https://laravel.com/docs/8.x/eloquent#observers) Model observer to handle soft delete relations between user and wallets;
- [Eloquent resources](https://laravel.com/docs/8.x/eloquent-resources) to standardize the json response for better handling;
- [Model factories](https://laravel.com/docs/8.x/database-testing#defining-model-factories) to seed database during unit tests;
- [Unit tests](https://laravel.com/docs/8.x/http-tests) to test api making http requests;
- [Dusk](https://laravel.com/docs/8.x/dusk) To make automatic browser tests (register, login and wallets);
- [Custom casts](https://laravel.com/docs/8.x/eloquent-mutators#custom-casts) to convert euro-cents to euro;
- [Jetstream](https://jetstream.laravel.com/) a starter kit for SPA.

## Requirements

- Docker
- Docker Compose
- Make

## Installation

1. Type `make build` to build the docker image
2. Type `make start` to start the docker containers and wait few seconds to let containers proper start
3. Type `make init` to initialize the application container (only the first time is required)

The `make init` command will lunch `composer install` and `php artisan migrate refresh --seed`

## Testing the application

Access the address [http://localhost:8000](http://localhost:8000) from your browser.
The installation `step 3` will ensure that fake data is present on the db in order to test the application.

Access the address [http://localhost:8025](http://localhost:8025) from your browser to access `mailhog` mail panel.

### Super admin access

Username: `admin@runitonce.com`
Password: `password`

### User access

Username: `user@runitonce.com`
Password: `password`

Other users are automatically generated by the seeder, so you can retrieve the email from the database connection
the password for all the seeder user is `password`

## Run the unit test

- Type `make test` to run the unit tests;
- Type `make dusk` to run the browser automation tests;
- Type `make testall` to run all the unit and dusk tests (laravel default ones included)

## Postman

Also a `postman_collection.json` file is provided in order to test the api by `Postman` You can also add the following 
test script to your `login` api request in order to save the `token` as variable inside your postman collection and use 
it for all subsequents calls:

```javascript
if (responseCode.code === 200) {
    var response = pm.response.text();
    pm.collectionVariables.set('token', response);
}
```

## Documentation

You can access the code documentation [here](http://localhost:8000/docs/index.html)

## Available `make` commands list

- `make build` build new docker image and clean everything after;
- `make start` start the containers;
- `make stop` stop the containers;
- `make restart` restart the containers;
- `make init` initialize the container installing dependencies and running migrations;
- `make shell` start new shell within the app container;  
- `make docs` build code documentation;
- `make test` run unit tests;
- `make dusk` run automatic browser tests;
- `make testall` run unit test and automatic browser tests;
- `make clean` remove unused docker layers.

## Known issue and improvements