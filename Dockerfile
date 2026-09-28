FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libsqlite3-dev libonig-dev \
    && docker-php-ext-install pdo_sqlite mbstring \
    && a2enmod rewrite \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database

COPY docker/entrypoint.sh /usr/local/bin/laravel-entrypoint
RUN chmod +x /usr/local/bin/laravel-entrypoint

ENV APP_ENV=production APP_DEBUG=false DB_CONNECTION=sqlite DB_DATABASE=/var/www/html/database/database.sqlite
EXPOSE 80
ENTRYPOINT ["laravel-entrypoint"]
