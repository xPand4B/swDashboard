#!/usr/bin/env bash
# DESCRIPTION: Initializes everything for development.

INCLUDE: ./../../cache/actions/clear.sh
INCLUDE: ./../../common/actions/clear.sh
INCLUDE: ./../../common/actions/.install-composer.sh
INCLUDE: ./../../common/actions/.install-npm.sh
INCLUDE: ./../../common/actions/.npm-run-dev.sh
INCLUDE: ./../../common/actions/.create-shopware-storage.sh

php artisan key:generate
