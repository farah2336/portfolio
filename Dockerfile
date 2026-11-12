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

# Setup Laravel environment file, key, and SQLite database
RUN cp .env.example .env || true
RUN php artisan key:generate || true
RUN mkdir -p /var/www/html/database && touch /var/www/html/database/database.sqlite

# Set correct permissions for storage, cache, and database
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database