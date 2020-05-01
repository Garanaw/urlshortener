#!/bin/sh

apt-get update -yqq && apt-get install -yqq \
    $PHPIZE_DEPS \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    libonig-dev \
    libmagickwand-dev \
    libxslt-dev libgcrypt-dev \
    libldap2-dev \
    libdb-dev \
    libssl-dev \
    php-cli php-mbstring
;
