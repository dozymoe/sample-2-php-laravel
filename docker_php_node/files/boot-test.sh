#!/bin/sh
cd /var/www/work || exit 1

./vendor/bin/duster -v lint || exit 2
./vendor/bin/phpstan analyse -l1 ./app/ || exit 3

php artisan migrate --force || exit 4
php artisan cache:clear
php artisan test || exit 5
