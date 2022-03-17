install:
	docker-compose up -d  --remove-orphans
	docker-compose exec php composer initial
	docker-compose run --rm php yarn dev
	docker-compose run --rm -e APP_ENV=test php composer initial

test:
	docker-compose run --rm -e APP_ENV=test php composer test

restart:
	docker-compose restart

build:
	sudo chmod 777 -R .docker/database
	docker-compose up -d --build

watch:
	docker-compose run --rm php yarn watch
