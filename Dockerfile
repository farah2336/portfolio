FROM php:8.3-apache

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Install required PHP extensions, SQLite libraries, and Node.js/npm
RUN apt-get update && apt-get install -y libzip-dev unzip sqlite3 libsqlite3-dev nodejs npm && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Set working directory to Laravel public folder directly
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy all project files (yeh aapki local database.sqlite file ko bhi sath le jayega)
COPY . /var/www/html/

# Build frontend assets (Vite CSS/JS)
RUN npm install && npm run build

# Setup SQLite Database directory and permissions
RUN mkdir -p /var/www/html/database && \
    chown -R www-data:www-data /var/www/html/database && \
    chmod -R 775 /var/www/html/database

# Setup Laravel cache configuration and storage link
RUN php artisan config:clear || true && \
    php artisan storage:link || true

# Set correct permissions for storage, cache, and database
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database