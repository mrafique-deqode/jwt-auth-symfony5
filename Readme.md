# Symfony 5 - Login/Register App with JWT Authentication

- This bundle provides JWT (Json Web Token) authentication for your Symfony APP.

# Author

- [@Mohammed Rafique](https://github.com/mrafique-deqode)


# Project Details

This is simple login/register application using JWT authentication.

- Login Form
- Registration Form
- Posts list after login


# Installation

Pre-requisites

- PHP5 or above
- Apache2 server
- MySQL server

Run below composer command:

`composer require symfony/maker-bundle --dev`

Database configuration in .env file in base directory
Change database credential in below parameter:

`DATABASE_URL="mysql://username:password@1@127.0.0.1:3306/dbname?serverVersion=8"`

Generate database And tables

`php bin/console doctrine:database:create`

`php bin/console doctrine:schema:update --force`

Run application

`symfony server:start`

OR

`php bin/console server:run`

If symfony not configured on your system use:

`php -S localhost:8000 -t public`



# Dependencies

- lexik/jwt-authentication-bundle
- knplabs/knp-paginator-bundle


To view the application: http://localhost:8000