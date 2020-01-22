# symfony-4-restful-api-example
Symfony 4 RESTful API Demo

About this repo

This API is based on FOSRESTBundle.

## Installation

* Download the code
* Create .env file based on .env.example
* Enter database credentials in env file
* Execute the `composer install` command to install the project dependencies
* Run `php bin/console doctrine:database:create`
* Run `php bin/console doctrine:schema:create`
* Run `php bin/console doctrine:fixtures:load` to fill the database with dummies users to test the code without creating users at the start
