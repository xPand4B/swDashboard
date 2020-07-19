#!/usr/bin/env bash

INCLUDE: ./../../common/actions/clear.sh
INCLUDE: ./.install-composer.sh
INCLUDE: ./.install-npm.sh
INCLUDE: ./.npm-run-prod.sh
INCLUDE: ./../../cache/actions/clear.sh

php artisan key:generate
