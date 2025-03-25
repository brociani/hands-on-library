FROM php:8.3-fpm-bookworm

ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer/composer:2-bin /composer /usr/bin/composer
WORKDIR /var/www/your-client
RUN apt-get -qq update && apt-get -qq -y install autoconf bash git make vim strace zip libzip-dev
RUN docker-php-ext-install zip
COPY ./ /var/www/your-client
COPY ./php.ini /usr/local/etc/php/
