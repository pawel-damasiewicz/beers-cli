FROM php:8.1-fpm AS build

WORKDIR /app

RUN apt-get clean
RUN apt-get update
RUN apt-get install -y libzip-dev zip
RUN docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer


FROM build AS composer_build
COPY composer.json .
COPY composer.lock .
RUN composer install --prefer-dist --no-interaction
COPY . .
RUN composer dump-autoload --optimize


FROM build AS dev
COPY . .

FROM php:8.1-fpm AS prod
WORKDIR /app
COPY --from=composer_build . .