FROM composer:latest AS composer
FROM php:7.4-alpine

ENV LC_ALL en_US.UTF-8
ENV LANG en_US.UTF-8
ENV WD=/var/www/symfony
ENV COMPOSER_MEMORY_LIMIT=-1

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk --no-cache add \
        sqlite \
    && apk --no-cache add \
        pcre-dev ${PHPIZE_DEPS} \
    && pecl install \
        xdebug \
        apcu \
    && docker-php-ext-enable \
        xdebug \
        apcu \
    && docker-php-ext-configure \
        opcache --enable-opcache \
    && docker-php-ext-install \
        opcache \
    && docker-php-source delete \
    && apk del pcre-dev ${PHPIZE_DEPS} \
    && rm -rf /tmp/* /var/cache/apk/*

WORKDIR $WD
COPY . $WD
RUN composer install -n --no-progress --classmap-authoritative --apcu-autoloader \
    && php bin/console d:d:c \
    && php bin/console d:s:c \
    && php bin/console d:f:l -n \
    && php bin/console c:c

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public/"]
