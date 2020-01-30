#!/usr/bin/env bash
# DESCRIPTION: Installs everything needed.

INCLUDE: ./../../cache/actions/clear.sh
INCLUDE: ./clear.sh
INCLUDE: ./.install-composer.sh
INCLUDE: ./.install-npm.sh
INCLUDE: ./.npm-run-prod.sh
INCLUDE: ./.create-shopware-storage.sh

php artisan key:generate
