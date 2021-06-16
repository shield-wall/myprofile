FROM php:8.0.7-fpm as base

RUN apt-get update

RUN apt-get install -y libpq-dev libzip-dev zlib1g-dev libicu-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip intl

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer

WORKDIR /app

FROM base as heroku_web

ARG APP_ENV
ARG APP_DEBUG
ARG GIT_REF

ARG MAILER_DSN
ARG MAILER_USER
ARG SENTRY_DSN
ARG TRANSLOADIT_KEY
ARG TRANSLOADIT_SECRET
ARG TRANSLOADIT_DELIVERY

ENV APP_ENV=$APP_ENV
ENV APP_DEBUG=$APP_DEBUG
ENV GIT_REF=$GIT_REF

ENV MAILER_DSN=$MAILER_DSN
ENV MAILER_USER=$MAILER_USER
ENV SENTRY_DSN=$SENTRY_DSN
ENV TRANSLOADIT_KEY=$TRANSLOADIT_KEY
ENV TRANSLOADIT_SECRET=$TRANSLOADIT_SECRET
ENV TRANSLOADIT_DELIVERY=$TRANSLOADIT_DELIVERY

RUN apt-get install -y curl gnupg2 ca-certificates lsb-release \
    && echo "deb http://nginx.org/packages/debian `lsb_release -cs` nginx" | tee /etc/apt/sources.list.d/nginx.list \
    && curl -fsSL https://nginx.org/keys/nginx_signing.key | apt-key add - \
    && apt-get update \
    && apt-get install -y nginx supervisor procps

COPY ./api/.docker/supervisor.conf /etc/supervisor/conf.d

COPY ./api/.docker/nginx/nginx_heroku.conf /etc/nginx/nginx.conf

RUN sed -i -E "s/127\.0\.0\.1:9000/\/var\/run\/php-fpm\/php-fpm.sock/" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i -E "s/127\.0\.0\.1:9000/\/var\/run\/php-fpm\/php-fpm.sock/" /usr/local/etc/php-fpm.d/www.conf.default \
    && sed -i -E "s/listen = 9000/;listen = 9000/" /usr/local/etc/php-fpm.d/zz-docker.conf \
    && mkdir /var/run/php-fpm

RUN chmod -R a+w /etc/nginx \
    # to run php-fpm (socker directory)
    && chmod a+w /var/run/php-fpm \
    && chmod a+w /usr/local \
    # to run nginx (default pid directory and tmp directory)
    && chmod -R a+w /var/run \
    && chmod -R a+wx /var/cache/nginx \
    && chmod -R a+wx /var/cache/nginx \
    # to run supervisor (read conf and create socket)
    && chmod -R a+r /etc/supervisor* \
    # to output logs
    && chmod -R a+w /var/log

CMD sed -i 's/PORT_NUMBER/'"$PORT"'/g' /etc/nginx/nginx.conf;supervisord --nodaemon;

USER www-data

COPY ./api/ /app

#FROM base as dev
#
#VOLUME /var/run/docker.sock:/var/run/docker.sock:ro
#
#RUN apt-get install -y git wget
#RUN pecl install xdebug && docker-php-ext-enable xdebug
#RUN curl https://cli-assets.heroku.com/install.sh | sh
#RUN apt-get -y install docker.io
#
##Nodejs and Yarn
#RUN curl -fsSL https://deb.nodesource.com/setup_15.x | bash - \
#    && apt-get install -y nodejs \
#    && npm install --global yarn
