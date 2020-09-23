#!/usr/bin/env bash
# DESCRIPTION: Clears all cache directories.

I: rm bootstrap/cache/*.php
I: php artisan cache:clear
I: php artisan route:clear
I: php artisan config:clear
I: php artisan view:clear
I: php artisan optimize:clear
