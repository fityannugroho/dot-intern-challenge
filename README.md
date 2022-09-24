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

# Database Structure

![Database Structure](/assets/erd.png)

There are 2 main tables in this database:

1. **`albums`** table contains the album data.
   This table has 3 columns:
   - `id` is the primary key and auto-incremented.
   - `name` is the album name.
   - `year` is the album release year.

2. **`songs`** table contains the song data.
   This table has 7 columns:
    - `id` is the primary key and auto-incremented.
    - `title` is the song title.
    - `artist` is the song artist.
    - `genre` is the song genre.
    - `duration` is the song duration in seconds.
    - `year` is the song release year.
    - `album_id` is the foreign key to the `albums` table.

The relationship between `albums` and `songs` table is one-to-many. One album can have many songs or no song at all, and one song can only have one album or no album at all.

The other tables are the auto-generated tables by Laravel. They are used for authentication and authorization. The `users` table is used for storing the user data, and the `password_resets` table is used for storing the password reset token. The `failed_jobs` table is used for storing the failed jobs. The `migrations` table is used for storing the migration history.
