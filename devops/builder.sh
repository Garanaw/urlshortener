#!/usr/bin/env bash

DOCKER_COMPOSE="-f $WORKING_DIR/docker-compose.yml"

up() {
    docker-compose ${DOCKER_COMPOSE} up
}

down() {
    docker-compose ${DOCKER_COMPOSE} down
}

build() {
    docker-compose ${DOCKER_COMPOSE} build
}

login() {
    CONTAINER="urlshortener_$1"
    docker exec -it $CONTAINER /bin/bash
}

install() {
    docker exec -w /var/www urlshortener_php chmod 777 storage
    docker exec -w /var/www urlshortener_php composer install
    docker exec -w /var/www urlshortener_php npm install
    docker exec -w /var/www urlshortener_php npm run prod
    docker exec -w /var/www urlshortener_php php artisan key:generate
    docker exec -w /var/www urlshortener_php php artisan storage:link
    docker exec -w /var/www urlshortener_php php artisan migrate:install
    docker exec -w /var/www urlshortener_php php artisan migrate
}
