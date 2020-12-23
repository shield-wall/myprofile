install:
	docker-compose up -d  --remove-orphans
	docker-compose exec php make init
	docker-compose run --rm client make yarn
	docker-compose run --rm -e APP_ENV=test php make init

init:
	make composer
	make db
	php bin/console hautelook:fixtures:load --no-interaction

composer:
	composer install --prefer-dist --no-ansi --no-interaction --no-progress --optimize-autoloader

db:
	php bin/console doctrine:database:create  --if-not-exists
	php bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction

test:
	bin/phpunit --coverage-clover coverage.xml

lint_phpcs:
	vendor/bin/phpcs

lint_twig:
	php bin/console lint:twig templates

lint_container:
	php bin/console lint:container

restart:
	docker-compose restart

build:
	sudo chmod 777 -R .docker/database
	docker-compose up -d --build

yarn:
	yarn
	yarn encore dev

watch:
	docker-compose run --rm client yarn encore dev --watch
