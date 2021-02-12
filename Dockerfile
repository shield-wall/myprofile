FROM php:7.4-fpm as base

RUN apt-get update

RUN apt-get install -y libpq-dev libzip-dev zlib1g-dev libicu-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip intl

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer

COPY ./ /app

#CMD "web: $(composer config bin-dir)/heroku-php-apache2 -i .docker/upload.ini public/"
CMD "php -S 0.0.0.0:443 -t public"

#FROM base as dev
#RUN apt-get install -y git
#RUN pecl install xdebug && docker-php-ext-enable xdebug
