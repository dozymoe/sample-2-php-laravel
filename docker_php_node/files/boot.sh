#!/bin/sh
cd /var/www/work || exit 1

mkdir -p \
        app/public \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views

composer install || exit 2

./vendor/bin/duster -v lint || exit 3
./vendor/bin/phpstan analyse -l1 ./app/ || exit 4
php artisan l5-swagger:generate || exit 5

npm install || exit 6
if [ -x ./node_modules/vite/bin/vite.js ]
then
    ./node_modules/vite/bin/vite.js build || exit 7
fi

php artisan migrate --force || exit 8
php artisan cache:clear
php artisan test || exit 9
php artisan schedule:run
exec php artisan serve --host=0.0.0.0
