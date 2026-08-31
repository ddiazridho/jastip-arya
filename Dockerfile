
# Base image
FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

# Install package linux yang dibutuhkan php & mysql 
RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    sqlite-dev \
    mysql-client

# Install PHP extension
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    zip \
    xml

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install compose json n lock dulu, agar tidak perlu install ulang di iterasi kedua 
COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --prefer-dist \
    --no-dev \
    --optimize-autoloader \
    --no-scripts

COPY . .

# Port FPM
EXPOSE 9000

# Run PHP FPM
CMD ["php-fpm"]

