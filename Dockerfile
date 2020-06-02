FROM crudml/backend-dev:latest

WORKDIR $WD
COPY . $WD
RUN composer install -n --no-progress --classmap-authoritative --apcu-autoloader \
    && composer clear-cache \
    && php bin/console cache:warmup \
    && php bin/console d:d:c \
    && php bin/console d:s:c \
    && php bin/console d:f:l -n

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public/"]
