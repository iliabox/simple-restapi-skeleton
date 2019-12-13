FROM alpine:latest

ENV LC_ALL en_US.UTF-8
ENV LANG en_US.UTF-8
ENV WD=/var/www/symfony
ENV COMPOSER_MEMORY_LIMIT=-1

RUN apk --no-cache add \
    composer curl sqlite \
    php7-curl php7-pcntl php7-intl php7-dom php7-mbstring php7-opcache php7-xml php7-xsl php7-sysvsem php7-fileinfo php7-simplexml php7-pdo php7-gd php7-ctype php7-sqlite3 php7-pdo_sqlite php7-bcmath php7-calendar php7-iconv php7-mbstring php7-tokenizer php7-apcu

COPY . $WD
WORKDIR $WD
RUN composer install -n --no-progress \
    && php bin/console d:d:c \
    && php bin/console d:s:c \
    && php bin/console d:f:l -n

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public/"]
