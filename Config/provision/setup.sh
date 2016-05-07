#!/bin/bash

#provision will run with root privilege by default

# mariadb default version
MARIADB_VERSION='5.5'
#root password
ROOTDBPWD='123'
#verbose output but didn't work
#VERBOSE='> /dev/null'
VERBOSE=''

echo "Provisioning virtual machine..."

echo "Update Software-Packages"
apt-get update > /dev/null

echo "Installing Apache2"
apt-get install -y apache2 $VERBOSE

echo "Installing PHP"
#maybe switch to php5-fpm
#apt-get install php5-common php5-dev php5-cli php5-fpm -y $VERBOSE
apt-get install php5 -y

echo "Installing PHP extensions"
# if we need extension
#apt-get install curl php5-curl php5-gd php5-mcrypt php5-mysql -y $VERBOSE
apt-get install php5-xdebug -y $VERBOSE
cp /vagrant/provision/config/zzzz-custom.ini /etc/php5/apache2/conf.d/

echo "Preparing MariaDB"
apt-get install debconf-utils -y $VERBOSE
export DEBIAN_FRONTEND=noninteractive
debconf-set-selections <<< "mariadb-server-$MARIADB_VERSION mariadb-server/root_password password $ROOTDBPWD"
debconf-set-selections <<< "mariadb-server-$MARIADB_VERSION mariadb-server/root_password_again password $ROOTDBPWD"

echo "Installing MariaDB"
apt-get install mariadb-server -y $VERBOSE

echo "Configuring Apache2"
cp /vagrant/provision/config/private-services.conf /etc/apache2/sites-available/private-services.conf
a2enmod rewrite $VERBOSE
a2ensite private-services $VERBOSE
service apache2 restart $VERBOSE