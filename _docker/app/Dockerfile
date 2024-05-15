FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
      build-essential \
      curl \
      apt-utils \
      libgd-dev \
      libpq-dev \
      libpng-dev \
      libjpeg-dev \
      libfreetype6-dev \
      libgif-dev \
      libzip-dev \
      libonig-dev \
      libxml2-dev \
      zip  \
      unzip  \
      git && \
      docker-php-ext-install pdo_mysql pcntl bcmath zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY --chown=www-data:www-data . .

ADD --chmod=775 _docker/app/entrypoint.sh /root/entrypoint.sh

#COPY _docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

ENTRYPOINT ["/root/entrypoint.sh"]
CMD ["php-fpm"]
