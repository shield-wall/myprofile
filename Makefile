install:
	docker-compose up -d
	docker-compose run --rm composer install
	docker-compose exec php bin/console doctrine:database:create  --if-not-exists
	docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction
	docker-compose run --rm client yarn encore dev

test:
	docker-compose run --rm  -e APP_ENV=test php-cli bin/phpunit

restart:
	docker-compose restart

build:
	sudo chmod 777 -R .docker/database
	docker-compose up -d --build

watch:
	docker-compose run --rm client yarn encore dev --watch