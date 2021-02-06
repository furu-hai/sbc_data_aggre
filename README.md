# Setup local
- Pre-condition
  
  - Docker
  - or [PHP](https://www.php.net/) / [Composer](https://getcomposer.org/) / [PostgreSQL](https://www.postgresql.org/)

- Pull project from git

- Create env file
```sh
cp .env.example .env
```

- Input env variables, e.g. DB connection
```
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=postgres
DB_SCHEMA_MASTER=public <-- schema for the collection data
DB_SCHEMA_SLAVES=slave1,slave2 <-- array of schemas of orgs, make sure you was create these schemas in db
```

- Install dependancy package
```sh
composer install
```

- Generate application key
```sh
php artisan key:generate
```

- Migrate DB
```sh
php artisan migrate
```

- Popular seed data
```sh
php artisan db:seed
```

- Start serve
```sh
php artisan serve
```

- Run batch
```sh
php artisan data:aagre contact
```
