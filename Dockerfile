FROM php:8.2-cli

WORKDIR /var/www/html

# Dependências do sistema + Node.js
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nano \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Código da aplicação
COPY . .

# Permissões
RUN chmod -R 775 storage bootstrap/cache

# Dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Dependências JS + build Vite
RUN npm install && npm run build

EXPOSE 1010

CMD php artisan serve --host=0.0.0.0 --port=1010
