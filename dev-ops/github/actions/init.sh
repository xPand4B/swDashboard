#!/usr/bin/env bash
# DESCRIPTION: Initialize the workflow.

INCLUDE: ./../../common/actions/.init-prod.sh

php artisan key:generate
