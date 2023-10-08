FROM php:8.0-apache
WORKDIR /var/www/html
COPY src .

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
RUN apt-get -y update && apt-get -y upgrade && apt-get install -y ffmpeg
RUN apt-get -y update && apt-get -y upgrade

RUN chown www-data /var/www/html/app/storage/episodes
RUN chmod 755 /var/www/html/app/storage/episodes
RUN chown www-data /var/www/html/app/storage/images
RUN chmod 755 /var/www/html/app/storage/images

EXPOSE 80