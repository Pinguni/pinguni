FROM php:7.4-fpm

RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \ 
    git \
    npm \
    curl \
    libonig-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sL https://deb.nodesource.com/setup_13.x  | bash -
RUN apt-get -y install nodejs

ARG CACHE_DATE=2020-09-07
#ADD "https://www.random.org/cgi-bin/randbyte?nbytes=10&format=h" skipcache

# Clone new folder
RUN git clone https://github.com/Pinguni/pinguni.git

# Set working directory to pinguni
WORKDIR pinguni

# Install dependencies
RUN composer install
RUN npm install
RUN npm run prod

# Laravel cache
CMD php artisan optimize:clear
CMD php artisan view:cache
CMD php artisan route:cache
CMD php artisan config:cache

# Serve app
CMD php artisan serve --host=0.0.0.0 --port=80
EXPOSE 80
