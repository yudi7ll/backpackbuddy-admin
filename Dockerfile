FROM php:7.2-fpm-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions pdo_mysql zip gd

# NPM
RUN apk add npm composer --no-cache

# configure file owner permissions
RUN adduser -DG www-data -u 1000 yudi
RUN chown -R yudi:www-data /var/www/html

# clean up
RUN rm /tmp/* -rf
