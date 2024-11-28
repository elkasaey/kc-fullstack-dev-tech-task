# Use the official PHP 8.3 with Apache base image
FROM php:8.3-apache

# Install system dependencies
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-enable zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite


# Expose necessary ports (if needed)
EXPOSE 80

