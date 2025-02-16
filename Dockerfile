# Need Node JS 14 which is available in Alpine Linux 3.13
FROM php:7.4-fpm-alpine3.13

# Arguments defined in docker-compose.yml
# ARG user
# ARG uid

RUN apk add --no-cache \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    sqlite \
    sqlite-dev \
    npm \
    nginx
    
RUN mkdir -p /run/nginx

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# RUN adduser -D -u $uid -G www-data -h /home/$user $user
# USER $user

CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"

# Needs to manually run after running docker compose up because it's mounted after it
# RUN chown -R www-data:www-data /var/www/html
# RUN composer install --optimize-autoloader --no-dev
# RUN npm install