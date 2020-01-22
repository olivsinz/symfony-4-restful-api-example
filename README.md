# symfony-4-restful-api-example
Symfony 4 RESTful API Demo

About this repo

This API is based on FOSRESTBundle.

## Installation

* Download the code
* Execute the `composer install` command to install the project dependencies
* Create .env file based on .env.example
* Enter database credentials in env file
* Run `php bin/console doctrine:database:create`
* Run `php bin/console make:migration`
* Run `php bin/console doctrine:migrations:migrate`
* Run `php bin/console doctrine:schema:update --force`
