#
# ---- PHP ----
FROM php:7.2.31-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
curl \
libssl-dev \
libmcrypt-dev \
libmagickwand-dev \
default-mysql-client

RUN pecl install imagick
RUN docker-php-ext-enable imagick

RUN docker-php-ext-install pdo_mysql

RUN apt-get install -y --no-install-recommends libzip-dev
RUN docker-php-ext-install zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
