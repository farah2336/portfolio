FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Update Apache DocumentRoot to point to Laravel's public folder
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Install PHP extensions required for Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Set correct permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80