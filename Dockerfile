FROM wordpress:php7.2-apache as wordpress
RUN docker-php-ext-install bcmath

VOLUME /var/www/html
CMD ["apache2-foreground"]



