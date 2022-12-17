install:
	docker compose up -d  --remove-orphans
	docker compose run --rm composer dev
	docker compose run --rm console php bin/console doctrine:database:create  --if-not-exists
	docker compose run --rm console bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction
	docker compose run --rm console bin/console hautelook:fixtures:load --no-interaction
	docker compose run --rm node npm run dev
	#docker compose run --rm -e APP_ENV=test php composer initial

test:
	docker-compose run --rm -e APP_ENV=test php composer test

restart:
	docker-compose restart

build:
	sudo chmod 777 -R .docker/database
	docker-compose up -d --build

watch:
	docker-compose run --rm php yarn watch

services-setup:
	#Dynamodb
	docker compose run --rm aws dynamodb create-table --attribute-definitions AttributeName=id,AttributeType=S --table-name cache --key-schema AttributeName=id,KeyType=HASH --billing-mode PAY_PER_REQUEST --endpoint-url http://dynamodb:8000
	docker compose run --rm aws dynamodb update-time-to-live --table-name cache --time-to-live-specification Enabled=true,AttributeName=ttl --endpoint-url http://dynamodb:8000
