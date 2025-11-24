FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copy project (will be mounted by compose; kept here for build-time installs)
COPY . /var/www/html

# Install PHP deps (non-fatal if composer.json missing during early builds)
RUN if [ -f composer.json ]; then composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader; fi

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
CMD ["php-fpm"]