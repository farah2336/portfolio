# FROM php:8.3-apache

# # Enable Apache Rewrite Module
# RUN a2enmod rewrite

# # Install required PHP extensions, SQLite libraries, and Node.js/npm
# RUN apt-get update && apt-get install -y libzip-dev unzip sqlite3 libsqlite3-dev nodejs npm && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# # Set working directory to Laravel public folder directly
# ENV APACHE_DOCUMENT_ROOT /var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# # Copy all project files (yeh aapki local database.sqlite file ko bhi sath le jayega)
# COPY . /var/www/html/

# # Build frontend assets (Vite CSS/JS)
# RUN npm install && npm run build

# # Setup SQLite Database directory and permissions
# RUN mkdir -p /var/www/html/database && \
#     chown -R www-data:www-data /var/www/html/database && \
#     chmod -R 775 /var/www/html/database

# # Setup Laravel cache configuration and storage link
# RUN php artisan config:clear || true && \
#     php artisan storage:link || true

# # Set correct permissions for storage, cache, and database
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database && \
#     chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
FROM php:8.3-apache

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Install required PHP extensions and Node.js/npm
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Set Apache DocumentRoot to Laravel public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Copy project files
COPY . /var/www/html/
WORKDIR /var/www/html

# Build frontend assets (Vite CSS/JS)
RUN npm install && npm run build

# Clear config cache and create storage symlink
RUN php artisan config:clear || true && \
    php artisan storage:link || true

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Bind Apache to Render's PORT (fallback 80) on 0.0.0.0
CMD ["sh", "-c", "PORT=${PORT:-80}; sed -ri \"s/Listen 80/Listen 0.0.0.0:${PORT}/g\" /etc/apache2/ports.conf; sed -ri \"s/<VirtualHost \\*:80>/<VirtualHost 0.0.0.0:${PORT}>/g\" /etc/apache2/sites-available/000-default.conf; exec apache2-foreground"]