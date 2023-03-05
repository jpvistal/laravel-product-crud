

## Installation

After cloning the repository, run the following commands

```
composer update
cp .env.example .env
php artisan key:generate
```
Before migrating the database, be sure that a database with the same name as the database set in the `.env` file is already existing

```
php artisan migrate:fresh --seed
```

Install and build package dependencies
```
npm install
npm run build
```

Lastly, run
```
php artisan serve
```

You can use the following credentials for logging in
```
email: admin@admin.com
password: password
```


