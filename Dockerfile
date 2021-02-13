FROM php:7.4-fpm as base

RUN apt-get update

RUN apt-get install -y libpq-dev libzip-dev zlib1g-dev libicu-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip intl

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer

WORKDIR /app

FROM base as build
COPY ./ /app
CMD "vendor/heroku-php-apache2 -i .docker/upload.ini public/"

#FROM base as dev
#
#VOLUME docker.sock:docker.sock:ro
#
#RUN apt-get install -y git wget
#RUN pecl install xdebug && docker-php-ext-enable xdebug
#RUN curl https://cli-assets.heroku.com/install.sh | sh
#RUN apt-get -y install docker.io
