#!/bin/bash
currentPhpVersion=$1
phpVersion=$2

a2dismod php$currentPhpVersion
a2enmod php$phpVersion
service apache2 restart

php -v
