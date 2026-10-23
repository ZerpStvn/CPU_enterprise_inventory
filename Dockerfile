FROM php:8.2-apache

RUN docker-php-ext-install mysqli

# Pages call header() after emitting HTML; shared hosts enable output buffering, the base image does not.
RUN { \
      echo 'output_buffering = 4096'; \
      echo 'display_errors = On'; \
      echo 'upload_max_filesize = 10M'; \
      echo 'post_max_size = 12M'; \
    } > /usr/local/etc/php/conf.d/app.ini

WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data uploads
