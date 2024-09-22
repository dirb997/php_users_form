FROM php:8.3.10-apache
RUN docker-php-ext-install pdo mysqli

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/c\<Directory \/var\/www\/html\/>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n<\/Directory>' /etc/apache2/apache2.conf

USER www-data