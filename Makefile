PHP_SERVICE := app
 
build:
	@docker-compose build

run:
	@docker-compose up -d

php:
	@docker-compose exec -it $(PHP_SERVICE) bash

install:
	@docker-compose exec -it $(PHP_SERVICE) composer install

migrate_run:
	@docker-compose exec -T $(PHP_SERVICE) php artisan migrate --seed

migrate_reset:
	@docker-compose exec -T $(PHP_SERVICE) php artisan migrate:reset
