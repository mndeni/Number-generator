# Use the official PHP 8 Alpine image as a base image
FROM php:8.0-fpm-alpine

# Install necessary PHP extensions and dependencies
RUN docker-php-ext-install pdo pdo_mysql

# Copy Composer from the Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application files to the container
COPY . .

# Install PHP dependencies
RUN composer install

# Set permissions (optional, but recommended)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 8080
CMD ["php-fpm"]
