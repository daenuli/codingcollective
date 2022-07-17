## Installation

Clone the repository.

```bash
git clone https://github.com/daenuli/codingcollective.git
```

Switch to the repository folder.

```bash
cd codingcollective
```

Use the package manager [composer](https://getcomposer.org/) to install required packages.

```bash
composer install
```

Create new database.

```bash
mysql -u root -p -e'create database coding'
```

Copy the example env file and changes config in the .env file.

```bash
cp .env.example .env
```

Generate new APP_KEY

```bash
php artisan key:generate
```

Run database migration

```bash
php artisan migrate
```

Seed database to get user account 

```bash
php artisan db:seed
```

Create a client for issuing access tokens

```bash
php artisan passport:client
```

Run development server

```bash
php artisan serve
```

Access development server at http://127.0.0.1:8000

Access API Documentation at http://127.0.0.1:8000/api/documentation

<!-- Access development server at http://127.0.0.1:8000 -->
<!-- Access API Documentation at http://127.0.0.1:8000/api/documentation -->