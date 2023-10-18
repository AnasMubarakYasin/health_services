#!/bin/bash

set -x
set -e

. ~/.nvm/nvm.sh
. ~/.profile
. ~/.bashrc

echo start update source code

php artisan down --secret="administrator"

git restore .
git pull

npm i
npm run build

node script pwa:remove
node script pwa:build

composer i

if [ $1 == '--reset' ]
then
    echo 'reset storage & data'

    php artisan storage:clear
    php artisan migrate:fresh
    php artisan db:seed
fi

php artisan up
php artisan app:notify-updates

echo finish update source code
