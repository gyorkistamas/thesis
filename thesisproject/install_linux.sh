#!/bin/bash

composer install --optimize-autoloader --no-dev
npm install
npm run build
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan event:cache
php artisan route:cache
