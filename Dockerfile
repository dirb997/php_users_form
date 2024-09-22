FROM php:8.3.10-apache
RUN docker-php-ext-install pdo mysqli

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

USER www-data
