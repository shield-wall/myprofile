API
===

it's a simple readme about api :)

# Dev setup

## Command line

Run tests

```shell
docker-compose run --rm -e APP_ENV=test php composer test
```

Run phpcs
```shell
docker-compose run --rm -e APP_ENV=test php composer lint_phpcs
```

## PHPStorm

### Configure tests

Open your `composer.json` and click on the icon `settings` :gear: front of `phpunit/phpunit`, it'll open `Test Framework` config window.
After that follow the steps bellow

- Add a new interpreter 
- PHPUnit by Remote Interpreter
- Choose or create php interpreter from docker-composer
- Path to script: `vendor/autoload.php`
- Default configuration file: `phpunit.xml.dist`
- Default bootstrap file: `tests/bootstrap.php`

### PHP CodeSniffer

Open your `composer.json` and click on the icon `settings` :gear: front of `squizlabs/php_codesniffer`, it'll open `PHP_CodeSniffer` config window.
After that follow the steps bellow

- Add a new interpreter
- Choose or create php interpreter from docker-composer
- PHP_CodeSniffer path: `vendor/bin/phpcs`
- Path to phpcbf: `vendor/bin/phpcbf`

