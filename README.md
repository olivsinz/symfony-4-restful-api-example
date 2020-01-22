# symfony-4-restful-api-example

## Installation

* Download the code
* Create .env file based on .env.example
* Enter database credentials in env file
* Run `composer install` to install the project dependencies
* Run `php bin/console doctrine:database:create`
* Run `php bin/console doctrine:schema:create`
* Run `php bin/console doctrine:fixtures:load` to fill the database with dummies users to test the code without creating users at the start
