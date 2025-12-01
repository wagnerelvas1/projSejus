FROM php:8.2-fpm-alpine

# Instala dependências do sistema
RUN apk add --no-cache bash\
    curl \
    git \
    build-base \
    libxml2-dev \
    autoconf \
    mysql-client \
    $PHPIZE_DEPS

# Instala extensões PHP
RUN docker-php-ext-install pdo pdo_mysql opcache

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
