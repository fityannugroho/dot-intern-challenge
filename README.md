# Album of Songs Web API

This project is a web app that allows users to create, read, update, and delete songs and albums. It also provides a RESTful API for the same functionality. The app is built using the [Laravel framework version 8](https://laravel.com/docs/8.x).

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

8. Generate the app resources (public assets, like: styles, scripts, etc.) with Laravel Mix.
    - In **development**, use `npm run dev` command. For watching the file changes (**watch mode**), use `npm run watch` command instead.
    - In **production**, use `npm run prod` command.

    > Note: Before **running in watch mode**, you need to start the application first.

9. Finally, start the application with `php artisan serve` command.

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

# Screenshots

## Login Page

![Screenshot Login Page](/assets/screenshot-1-login.png)

## Dashboard Page

![Screenshot Dashboard Page](/assets/screenshot-2-dashboard.png)

## Albums Page

![Screenshot Albums Page](/assets/screenshot-3-albums.png)

## Songs Page

![Screenshot Songs Page](/assets/screenshot-4-songs.png)

## Add Album Page

![Screenshot Add Album Page](/assets/screenshot-5-add-album.png)

## Detail Album Page

![Screenshot Detail Album Page](/assets/screenshot-6-detail-album.png)

## Detail Song Page

![Screenshot Detail Song Page](/assets/screenshot-7-detail-song.png)

## Edit Song Page

![Screenshot Edit Song Page](/assets/screenshot-8-edit-song.png)

# Dependencies

- [Laravel](https://laravel.com/) v8.12.3
- [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum) v2.11
- [Laravel Mix](https://laravel.com/docs/8.x/mix) v6.0.6
- [Bootstrap](https://getbootstrap.com/) v5.2.1

# Testing

## Postman

You can import the Postman collection from the `postman` directory to test the API.

Import the [**`DOT Intern Challenge.postman_collection.json`**](/postman/DOT%20Intern%20Challenge.postman_collection.json) and [**`DOT Intern Challenge.postman_environment.json`**](/postman/DOT%20Intern%20Challenge.postman_environment.json) files to your Postman application (see [Importing and exporting data](https://learning.postman.com/docs/getting-started/importing-and-exporting-data/)).

Finally, you can run the Postman collection to test the API (see [Running collections in Postman](https://learning.postman.com/docs/running-collections/intro-to-collection-runs/)).
