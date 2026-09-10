FROM php:8.3-apache

# Install MySQL/PDO extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

# Set Apache document root to public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

COPY . /var/www/html

# Create runtime directory and set permissions
RUN mkdir -p /var/www/html/runtime && \
    chown -R www-data:www-data /var/www/html/runtime

EXPOSE 80

CMD ["apache2-foreground"]