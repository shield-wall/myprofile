up:
	make up-api

up-api:
	docker-compose up -d  --remove-orphans
	docker-compose exec worker composer initial
	docker-compose run --rm client yarn dev
	docker-compose run --rm -e APP_ENV=test worker composer initial

test:
	docker-compose run --rm -e APP_ENV=test worker composer test

restart:
	docker-compose restart

build:
	sudo chmod 777 -R .docker/database
	docker-compose up -d --build

watch:
	docker-compose run --rm worker yarn watch
