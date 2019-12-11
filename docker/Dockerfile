FROM php:7.3-cli

WORKDIR app

RUN apt-get update && apt-get install -y \
    git

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# wkhtmltopdf
RUN apt-get -qy install --no-install-recommends wget

RUN wget -nv -O /tmp/wkhtmltox.deb https://downloads.wkhtmltopdf.org/0.12/0.12.5/wkhtmltox_0.12.5-1.stretch_amd64.deb
RUN apt-get -qy install /tmp/wkhtmltox.deb

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony