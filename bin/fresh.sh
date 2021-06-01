#!/bin/env bash

docker-compose exec php php artisan migrate:fresh --seed
docker-compose exec php php artisan passport:install --force
rm -rf public/storage/Itinerary
mkdir -p public/storage/Itinerary/thumb
cp -rf public/storage/samples/* public/storage/Itinerary/
cp -rf public/storage/samples/* public/storage/Itinerary/thumb
echo 'Done'
