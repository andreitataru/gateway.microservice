set -e
export HOME=/root

# Install PHP and dependencies from apt
apt-get update
apt-get install -y git nginx php7.2 php7.2-fpm php7.2-mysql php7.2-dev \
    php7.2-mbstring php7.2-zip php-pear pkg-config

# Install Composer
sudo curl -sS https://getcomposer.org/installer | \
    /usr/bin/php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

#gcloud compute instances create ptr-pti-backend --image-family=ubuntu-1804-lts --image-project=ubuntu-os-cloud --machine-type=g1-small --scopes userinfo-email,cloud-platform --metadata-from-file startup-script=scripts/startup.sh --tags http-server