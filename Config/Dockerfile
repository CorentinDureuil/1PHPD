FROM php:8.2-apache

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y zlib1g-dev libwebp-dev libpng-dev libzip-dev && \
    docker-php-ext-install gd zip

RUN a2enmod rewrite && \
    a2enmod autoindex

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .htaccess /var/www/html/.htaccess

RUN chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www

EXPOSE 80
