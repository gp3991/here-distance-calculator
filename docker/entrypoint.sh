#!/bin/sh

# Run entrypoint from original setup
docker-php-entrypoint

# Install composer packages if vendor doesn't exist'
if [ ! -d "vendor" ] ; then
  composer install --no-interaction
fi

# Add docker host to /etc/hosts
/sbin/ip -4 route list match 0/0 | awk '{print $3 " host.docker.internal"}' >> /etc/hosts

apache2-foreground