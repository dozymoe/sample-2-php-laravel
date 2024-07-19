FROM php:8.2

ARG uid
ARG gid

# These files can become huge, gigabytes
# See: https://github.com/sagemathinc/cocalc/issues/2287
RUN rm /var/log/faillog /var/log/lastlog

RUN apt-get update && apt-get install -y nodejs npm yarnpkg

RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev \
    libpng-dev
RUN docker-php-ext-configure gd && docker-php-ext-install -j$(nproc) gd
RUN apt-get update && apt-get install -y --no-install-recommends libgmp-dev \
    && docker-php-ext-install gmp
RUN apt-get update && apt-get install -y --no-install-recommends libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring pdo exif sockets pcntl bcmath
RUN apt-get update && apt-get install -y --no-install-recommends libzip-dev \
    && docker-php-ext-install zip
RUN pecl install redis && docker-php-ext-enable redis

RUN apt-get update && apt-get install -y unzip vim-tiny

RUN apt-get autoclean -y && rm -rf /var/lib/apt/lists/* && rm -rf /tmp/pear/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY files/boot.sh /docker-init.sh
COPY files/boot-test.sh /docker-init-test.sh

RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN sed -i '/max_execution_time/s/30/300/' "$PHP_INI_DIR/php.ini"
RUN sed -i '/memory_limit/s/128M/512M/' "$PHP_INI_DIR/php.ini"

RUN groupadd -g $gid mygroup
RUN useradd -G root -u $uid -g $gid -d /home/user -m -s /bin/bash myuser
RUN mkdir -p /var/www/work && chown -R myuser:mygroup /var/www/work

USER myuser:mygroup
WORKDIR /var/www/work

HEALTHCHECK CMD curl --fail http://localhost:8000 || exit 1
STOPSIGNAL SIGINT
CMD ["/docker-init.sh"]
