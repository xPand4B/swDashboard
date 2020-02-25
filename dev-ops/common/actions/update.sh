#!/usr/bin/env bash
# DESCRIPTION: Updates the application (checkout master + git stash)

I: git stash
I: git pull origin release

INCLUDE: ./.install-composer.sh
INCLUDE: ./.create-shopware-storage.sh
INCLUDE: ./../../cache/actions/clear.sh

php artisan key:generate
