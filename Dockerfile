ARG PHP_VERSION=8.2

# Build base
FROM acrsenetshared001.azurecr.io/senet/php-fpm-buster:${PHP_VERSION} AS base
RUN apt update && install-php-extensions mbstring gd intl amqp pdo pdo_mysql
COPY .docker/php/conf.d/maxupload.ini $PHP_INI_DIR/conf.d/
COPY .docker/php/conf.d/memory.ini $PHP_INI_DIR/conf.d/
COPY .docker/php/conf.d/opcache.ini $PHP_INI_DIR/conf.d/
WORKDIR /app

# Build prod
FROM acrsenetshared001.azurecr.io/onderwijscatalogus/app-base:latest AS prod
COPY --chown=senet:senet . /app
USER senet

# Build dev
FROM acrsenetshared001.azurecr.io/onderwijscatalogus/app-base:latest AS dev
USER root
RUN install-php-extensions xdebug
COPY .docker/php/conf.d/dev/xdebug.ini $PHP_INI_DIR/conf.d/

# Build dev-local
FROM acrsenetshared001.azurecr.io/onderwijscatalogus/app-dev:latest AS local
ARG UID=${UID:-10000}
ARG GID=${GID:-10001}
ARG USER=${USER:-senet}
RUN usermod -u $UID $USER && groupmod -g $GID $USER