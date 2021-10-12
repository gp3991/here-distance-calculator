# here-distance-calculator

## Environment:

PHP 8.0.6, SQLite

### DEV Docker stack:
`php:8.0.6-apache`

## Configuration

### Required config
Create .env file in project root:
```dotenv
# SQLite db file location
DB_FILE=var/db.sqlite
# Here API key 
HERE_API_KEY=apikey
```

## Running project
```shell
docker-compose up --build -d
bin/init-database # or src/Command/init-db.php in docker container 
```

### PHP Coding Standards Fixer

Please use `bin/php-cs-fixer` command or IDE inspection tools to keep up with `@Symfony` rules.
Configuration can be found in `.php-cs-fixer.dist.php`