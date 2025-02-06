FROM php:8.4.3-fpm

RUN apt-get update && apt-get install -y libzip-dev unzip cron
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin
RUN docker-php-ext-install zip pdo pdo_mysql
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs && npm install -g npm@latest

COPY ./templates/php.conf /usr/local/etc/php-fpm.d/zzz-custom.conf

RUN echo "* * * * * /usr/local/bin/php /srv/www/artisan schedule:run >> /dev/null 2>&1" > /etc/cron.d/laravel-scheduler
RUN chmod 0644 /etc/cron.d/laravel-scheduler
RUN crontab /etc/cron.d/laravel-scheduler

WORKDIR /srv/www

CMD ["php-fpm"]
