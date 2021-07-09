#!/bin/env bash

lando artisan migrate:fresh --seed
lando artisan passport:install --force
rm -rf public/storage/Itinerary
mkdir -p public/storage/Itinerary/thumb
cp -rf public/storage/samples/* public/storage/Itinerary/
cp -rf public/storage/samples/* public/storage/Itinerary/thumb
echo 'Done'
