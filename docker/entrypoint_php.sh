#!/bin/sh

composer install

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console server:run 0.0.0.0:8000

