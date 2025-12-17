# Estágio 1: PHP e Dependências
FROM php:8.3-fpm-alpine

# Instalar extensões necessárias do PHP
RUN apk add --no-cache \
    zip libzip-dev libpng-dev icu-dev libpq-dev \
    && docker-php-ext-install pdo_mysql zip gd intl opcache

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do Composer (sem dev)
RUN composer install --no-dev --optimize-autoloader

# Ajustar permissões para o Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Porta exposta para o Coolify (geralmente via Proxy)
EXPOSE 9000

CMD ["php-fpm"]
