# Installation

1. Clone this repository.
2. Install the dependencies. Run `composer install` command, then run `npm install` command.
3. Create `.env` file by simply copying the `.env.example` file and rename it.
4. Make sure you have a database created and the database server is running.
5. Configure the `.env` file with your **database connection**, **seeder configuration**, etc.
6. Generate the application key with `php artisan key:generate` command.
7. Generate the database structure with this commands based on your preferences:
   - Use **`php artisan migrate`** for [creating / updating the database](https://laravel.com/docs/8.x/migrations).
   - Use **`php artisan db:seed`** for [seeding the database](https://laravel.com/docs/8.x/seeding#running-seeders).
   - Use `php artisan migrate:fresh` for fresh installation.
   - Use `php artisan migrate:fresh --seed` for fresh installation and seeding the database.

> **Warning!** If you use `php artisan migrate:fresh` command, all tables will be dropped and recreated. **All data in the tables will be lost**.

8. Finally, start the application with `php artisan serve` command.

# API Documentation

The API documentation is available at https://github.com/fityannugroho/dot-intern-challenge/wiki/API-Documentation.
