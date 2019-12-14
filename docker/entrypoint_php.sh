#!/bin/sh

composer install

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force

symfony server:ca:install
symfony server:start

