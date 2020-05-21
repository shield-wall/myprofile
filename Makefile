install:
	docker-compose run --rm composer install
	docker-compose run --rm php bin/console doctrine:database:create  --if-not-exists
	docker-compose run --rm php bin/console doctrine:migrations:migrate --no-interaction
	docker-compose run --rm client yarn encore dev
	docker-compose up -d

test:
	docker-compose run --rm  -e APP_ENV=test php-cli bin/phpunit

restart:
	docker-compose restart

build:
	sudo rm -rf .docker/database
	docker-compose build

watch:
	docker-compose run --rm client yarn encore dev --watch