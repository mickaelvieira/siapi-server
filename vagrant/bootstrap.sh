#!/bin/bash

set -x
sudo apt-get update
mkdir -p /etc/puppet/modules

puppet module install example42/puppi --version 2.1.10 --force
puppet module install puppetlabs/stdlib --version 4.5.1 --force
puppet module install puppetlabs/concat --version 1.2.0 --force
puppet module install example42/php --version 2.0.19 --force
puppet module install puppetlabs-apache --version 1.4.0 --force
puppet module install puppetlabs/mysql --version 3.3.0 --force
puppet module install puppetlabs/apt --version 1.8.0 --force
puppet module install nanliu/staging --version 1.0.3 --force
puppet module install puppetlabs/rabbitmq --version 5.1.0 --force