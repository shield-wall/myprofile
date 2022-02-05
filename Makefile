install:
	docker-compose pull

	make client-install
	make api-install

	docker-compose up -d  --remove-orphans

api-install:
	docker-compose run --rm php composer initial
	docker-compose run --rm -e APP_ENV=test php composer initial

client-install:
	docker-compose run --rm client yarn install
	docker-compose run --rm client yarn avatar

php:
	docker-compose run --rm php bash

client:
	docker-compose run --rm client bash
