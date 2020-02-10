#!/usr/bin/env bash
# DESCRIPTION: Clears all installed stuff - !!! INCLUDING SW INSTANCES !!!

I: rm -rf vendor
I: rm -rf node_modules

#I: rm -rf public/6-*
#I: rm -rf public/5-*
#I: rm -rf public/4-*
#
#I: rm -rf storage/app/public/shopware/sw6/*
#I: rm -rf storage/app/public/shopware/sw5/*
#I: rm -rf storage/app/public/shopware/sw4/*

I: rm -rf public/storage
I: rm public/*.js
I: rm storage/debugbar/*.json
