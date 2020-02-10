#!/usr/bin/env bash
# DESCRIPTION: Installs everything needed.

INCLUDE: ./clear.sh
INCLUDE: ./.install-composer.sh
INCLUDE: ./.install-npm.sh
INCLUDE: ./.npm-run-prod.sh
INCLUDE: ./.create-shopware-storage.sh
INCLUDE: ./../../cache/actions/clear.sh

php artisan key:generate
