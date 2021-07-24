API
===

it's a simple readme about api :)

## Dev setup

### Run tests using command line

```shell
docker-compose run --rm -e APP_ENV=test php bin/phpunit
```

### Run tests in jetbrains

if you wish configure phpstorm, open `Preferences` > `PHP` > `Test Framework`

- Add a new interpreter 
- PHPUnit by Remote Interpreter

then use docker-composer as `CLI interpreter` and after that put

- Path to script: `vendor/autoload.php`
- Default configuration file: `phpunit.xml.dist`
- Default bootstrap file: `tests/bootstrap.php`
