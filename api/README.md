API
===

it's a simple readme about api :)

# Dev setup

## Command line

execute: `make php` to access the php container, after that you are able to run the commands bellow!
Run tests

```shell
composer test
```

Run phpcs
```shell
composer lint:phpcs
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

