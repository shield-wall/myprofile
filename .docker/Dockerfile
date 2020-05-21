FROM php:7.3-fpm

RUN apt-get update

RUN apt-get install -y libpq-dev libzip-dev zlib1g-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip