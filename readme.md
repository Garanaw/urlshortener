# Url Shortener

## Installation

In order to run the application, there are two ways:

1. Using Docker
2. Using a host web server

### Using Docker:

To run the application in Docker, Git and Docker must be installed in the system. Pull the repository in your preferred directory, and run the following commands:

First, run the following command to generate the required .env files:
`./dev.sh env`

If the previous command has not been ran, the next commands will fail. To build the images, run:
`./dev.sh build`

This will build the required images to run the application: MySQL:8.0, PHP:7.4.4, Redis, NginX. Be aware that this step might take a while.

Run this command to generate the application key, create the migration table, run all the migrations, install the required composer and node packages and compile the npm modules:
`./dev.sh install`

Once all the above is done, you can run `./dev.sh up` to start the containers. Access `localhost` from your browser, and the application should be running.

#### Caveat

If you have MySQL, Apache, NginX or any other application that uses the ports 80, 443 and/or 3306, turn them off, as they will conflict with the containers and they will not start.
Another approach is to change the ports in the .env file located in the root folder. Don't forget to use them in your browser.

### Using your own web server:

To run the application without Docker, you must have installed Apache OR NginX, MySQL (preferable 8) and PHP 7.4, Redis (to manage the cache), Composer and Node/NPM. Copy the files located in the src directory to your own server root directory, and change the key `DB_HOST` under the .env file to `localhost`. Navigate to that directory with the console. Run the following commands:

`composer install`
`npm install`
`npm run prod`
`php artisan key:generate`
`php artisan storage:link`
`php artisan migrate:install`
`php artisan migrate`

## The DEV Wrapper:

There are some common commands wrapped in this script. The most likely to be used are:

`./dev.sh up`
To bring the containers up (start the server)

`./dev.sh login <container_name>`
This will give access to the selected container. The containers are all prefixed with `urlshortener_`, but this should be avoided as the wrapper will add it to the command. The containers are:

1. php
2. redis
3. mysql
4. nginx
