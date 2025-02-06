# PHP backend task

## Requirements:

- Use **preinstalled laravel** project
- Use **latest stable php** version
- **GIT** version control
- Mysql database
- **Bootstrap** or any other **CSS** framework for frontend

## Task
A simple web application with the following:

* Write a command which imports products from a given JSON file ``storage/app/public/products.json``
* Write a **scheduled** command which imports products stock from given JSON file ``storage/app/public/products.json``
* Write a **JSON API** endpoint which can list all existing products
* Frontend:
    * list all products with simple search by description
    * single product page
* Use basic caching

## Tips
* Fork this repository and make your own
* Feel free to update laravel installation and other packages
* Feel free to use existing docker configuration
* Feel free to add any additional functionality
* Write a detailed description on how to launch project if you chose not to use existing docker configuration
* Keep everything simple


docker compose -f docker/compose.yml --env-file src/.env.example up -d --build
docker exec php-fpm sh -c "cp .env.example .env && composer install && php artisan migrate:install && php artisan migrate && php artisan key:generate && npm install && npm run build && php artisan app:import-product && cron"
