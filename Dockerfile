FROM php:8.0-fpm-alpine
WORKDIR /var/www

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ bash icu-dev libzip-dev rabbitmq-c rabbitmq-c-dev \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        intl \
        zip \
        pdo_mysql

ADD etc/infrastructure/php/extensions/rabbitmq.sh /root/install-rabbitmq.sh
ADD etc/infrastructure/php/extensions/xdebug.sh /root/install-xdebug.sh

RUN apk add git
RUN sh /root/install-rabbitmq.sh
RUN sh /root/install-xdebug.sh

RUN docker-php-ext-enable \
        amqp 

RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY etc/infrastructure/php/ /usr/local/etc/php/