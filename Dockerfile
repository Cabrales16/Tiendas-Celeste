# Versión PHP de Tiendas Celeste (Apache + mysqli). Se usa junto con docker-compose.yml.
FROM php:8.2-apache
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
