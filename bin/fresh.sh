#!/bin/env bash

docker-compose exec php php artisan migrate:fresh --seed
rm -rf public/storage/Itinerary
mkdir -p public/storage/Itinerary/thumb
cp -rf public/storage/samples/* public/storage/Itinerary/
cp -rf public/storage/samples/* public/storage/Itinerary/thumb
echo 'Done'
