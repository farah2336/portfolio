FROM php:8.3-apache

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Install required PHP extensions
RUN apt-get update && apt-get install -y libzip-dev unzip && docker-php-ext-install pdo pdo_mysql zip

# Set working directory to Laravel public folder directly
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy all project files
COPY . /var/www/html/

# Setup Laravel environment file, key, and cache configuration
RUN cp .env.example .env || true
RUN php artisan key:generate || true
RUN php artisan config:clear || true

# Set correct permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache