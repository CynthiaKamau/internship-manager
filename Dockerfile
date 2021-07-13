# Set the base image for subsequent instructions
FROM php:7.4

# Update packages
RUN apt-get update

# Install PHP and composer dependencies
RUN apt-get install -qq git curl libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev libzip-dev

# Clear out the local repository of retrieved package files
RUN apt-get clean

# Install needed extensions
# Here you can install any other extension that you need during the test and deployment process
RUN docker-php-ext-install exif fileinfo gd session gettext pdo pdo_mysql zip

RUN a2enmod rewrite

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini


COPY php.ini /usr/local/etc/php/
COPY . /var/www/html/

# Install Composer
RUN curl --silent --show-error "https://getcomposer.org/installer" | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel Envoy
RUN composer global require "laravel/envoy=~1.0"

RUN curl -sL https://deb.nodesource.com/setup_15.x | bash

RUN apt-get install -y nodejs
