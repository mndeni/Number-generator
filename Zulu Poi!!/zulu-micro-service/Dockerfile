# Use the official PHP image as the base image
FROM php:8.0-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apk --no-cache add \
        git \
        openssh-client \
        postgresql-dev \
        libmcrypt-dev \
        libzip-dev \
        zip \
        unzip \
        icu-dev \
        oniguruma-dev \
        autoconf \
        g++ \
        make

RUN docker-php-ext-install pdo pdo_mysql

# Install MongoDB extension
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Copy composer from the official composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install

# Copy the application files
COPY . .

# Change ownership and permissions of application files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
