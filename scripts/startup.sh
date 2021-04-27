set -e
export HOME=/root

# Install PHP and dependencies from apt
apt-get update
apt-get install -y git nginx php7.4 php7.4-fpm php7.4-mysql php7.4-dev \
    php7.4-mbstring php7.4-zip php-pear pkg-config \
        freetype \
        freetype-dev \
        libpng \
        libpng-dev \
        libjpeg-turbo \
        libjpeg-turbo-dev \
            libjpeg \
        libtool \
        libxml2-dev \
        make \
        g++ \
        autoconf \
        imagemagick-dev \
        libtool \
        && docker-php-ext-install gd \
        && docker-php-ext-configure gd \
            --with-freetype \
            --with-jpeg \
        && docker-php-ext-install mbstring \
        && docker-php-ext-install mysqli \
        && pecl install imagick \
        && docker-php-ext-enable imagick \
        && apk del autoconf g++ libtool make \
        && rm -rf /tmp/* /var/cache/apk/*

# Install Composer
sudo curl -sS https://getcomposer.org/installer | \
    /usr/bin/php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

#gcloud compute instances create ptr-pti-backend --image-family=ubuntu-1804-lts --image-project=ubuntu-os-cloud --machine-type=g1-small --scopes userinfo-email,cloud-platform --metadata-from-file startup-script=scripts/startup.sh --tags http-server