FROM php:8.0.6-apache

# Enable apache mod_rewirte
RUN a2enmod rewrite

# Install php extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    iproute2 unzip \
    && pecl install xdebug-3.0.4 \
    && docker-php-ext-enable xdebug

# Copy additional php configuration
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# For PhpStorm xdebug serverMap
ENV PHP_IDE_CONFIG="serverName=127.0.0.1"

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Copy fix-perms script
COPY fix-perms /usr/local/bin/fix-perms

# Copy and set entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]