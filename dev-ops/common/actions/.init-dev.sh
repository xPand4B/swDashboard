#!/usr/bin/env bash

INCLUDE: ./../../cache/actions/clear.sh
INCLUDE: ./.install-composer.sh
INCLUDE: ./.install-npm.sh
INCLUDE: ./.npm-run-dev.sh
INCLUDE: ./.cache.sh

php artisan key:generate
