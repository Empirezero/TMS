FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_sqlite zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

RUN npm install && npm run build

EXPOSE 10000

CMD php artisan migrate --force && php artisan storage:link && php artisan serve --host 0.0.0.0 --port 10000