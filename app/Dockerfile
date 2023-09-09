FROM php:8.0-apache

# package
RUN apt update \
    && docker-php-ext-install pdo_mysql

EXPOSE 80