FROM php:8.3-apache

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Install required PHP extensions (pdo_sqlite bhi add kar diya hai)
RUN apt-get update && apt-get install -y libzip-dev unzip && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Set working directory to Laravel public folder directly
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy all project files
COPY . /var/www/html/

# Setup SQLite Database directory, file, and permissions
RUN mkdir -p /var/www/html/database && \
    touch /var/www/html/database/database.sqlite && \
    chown -R www-data:www-data /var/www/html/database && \
    chmod -R 775 /var/www/html/database

# Setup Laravel environment file, key, and cache configuration
RUN cp .env.example .env || true
RUN php artisan key:generate || true
RUN php artisan config:clear || true

# Run database migrations automatically during build/startup
RUN php artisan migrate --force || true

# Set correct permissions for storage, cache, and database
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database