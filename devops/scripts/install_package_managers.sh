#!/bin/sh

# Install composer
curl -sS https://getcomposer.org/installer | php 
    #-- --install-dir=/usr/local/bin --filename=composer
mv composer.phar /usr/local/bin/composer

# NPM for frontend builds
curl -sL https://deb.nodesource.com/setup_13.x | bash
apt install -y nodejs
