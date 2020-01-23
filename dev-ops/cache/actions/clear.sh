#!/usr/bin/env bash
# DESCRIPTION: Clears all cache directories.

I: rm bootstrap/cache/*.php
I: rm storage/debugbar/*.json
I: php artisan optimize:clear
