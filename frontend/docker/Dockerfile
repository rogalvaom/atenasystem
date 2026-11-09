FROM php:8.2-apache

# Instalar dependências e o driver pdo_mysql
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql

# Habilitar reescritas no Apache
RUN a2enmod rewrite

# Instalar o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer