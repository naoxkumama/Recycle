#!/bin/sh
cp .env.production .env
rm -rf public/build
npm install --legacy-peer-deps
npm run build
php artisan config:clear
php artisan route:cache || true
php artisan config:cache || true
php artisan view:cache || true