#!/usr/bin/env bash
# DESCRIPTION: Clears all installed stuff.

I: php artisan key:generate
I: rm -rf vendor
I: rm -rf node_modules

I: rm -rf public/storage
I: rm public/*.js
I: rm storage/debugbar/*.json
