FROM php:7.3-cli

WORKDIR app

RUN apt-get update && apt-get install -y \
    git

RUN apt-get install -y libpq-dev libzip-dev zlib1g-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# symfony
RUN apt-get -qy install --no-install-recommends wget
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony