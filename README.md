# Run it once assignment test

## Preface

The purpose of the assignement is to create a bunch of api to manage the player wallets and a frontend
application that will consume that apis. More info at `assignment-202107.docx`

We know that it is possilble to use custom authentication solution but why we have to reinvent the wheel
when `Laravel` is already providing many ways to authenticate a user via SPA and consume api? So I decided
to use `Laravel Sancutm` rather than `Laravel Passport` and make use of `axios` library to consume the apis
from the frontend application. I've also choose to use my own custom docker image rather than `Laravel Sail`.
The purpose to use custom docker image and configuration is just to show the level expirience with `Docker`

The application is making use the following `Laravel` features
    - Sanctum to authenticate api calls
    - Policies to authorize user abilities
    - Form Requests
    - Model observer to handle soft delete relations between user and wallets
    - Model resources to standardize the json response for better handling
    - Model factories to seed database during unit tests
    - Unit test to test api via http request
    - Dusk to make browser QA tests (register, login and wallets)
    - Custom casts to convert euro-cents to euro
    - Jetstream a starter kit for SPA

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

You can access the address `http://localhost:8000` from your browser.
The installation step 3 will ensure that fake data is present on the db in order to test the application.

You can access the address `http://localhost:8025` from your browser to access `mailhog` mail panel.

### Super admin access

Username: `admin@runitonce.com`
Password: `password`

### User access

Username: `user@runitonce.com`
Password: `password`

Other users are automatically generated by seeder so you can retrieve the email from database connection
the password for all the seeder user is `password`

## Run the unit test

Type `make test` to run the unit test already present to the project
Type `make dusk` to run the dusk test already present to the project
Type `make testall` to run all the unit and dusk present to the project

## Postman

Also a `postman_collection.json` file is provided in order to test the api by postman
You can also add the following test script to your `login` api request in order to save 
the `token` as variable inside your postman collection and use it for all subsequents
calls:

```javascript
if (responseCode.code === 200) {
    var response = pm.response.text();
    pm.collectionVariables.set('token', response);
}
```

## Documentation

You can access code documentation at http://localhost:8000/docs/index.html

## Known issue and improvements