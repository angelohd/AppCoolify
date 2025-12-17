FROM php:8.2-cli

# Diretório de trabalho
WORKDIR /var/www/html

# Dependências básicas do Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Código da aplicação
COPY . .

# Permissões
RUN chmod -R 775 storage bootstrap/cache

# Dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Porta usada pelo artisan serve
EXPOSE 1010

# Start da aplicação Laravel
CMD php artisan serve --host=0.0.0.0 --port=1010
