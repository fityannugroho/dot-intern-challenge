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

The base URL for the API is `http://localhost:8000/api/`.

In order to use the API, you need to authenticate yourself. You can do this by sending a POST request to [login](#login) endpoint with your credentials. The response will contain a token that you need to send with every request to the API. You can do this by adding `Authorization` header to your request. The value of the header should be `Bearer <token>`.

## Response Format

The API uses JSON format for responses. The response will always contain the following fields:

- **status**: string - Either `success` or `fail`.
- **status_code**: integer - The HTTP status code.
- **message**: string or array of strings - The message or messages that describe the response.

If the request was **successful**, the response will also contain the following fields:

- **data**: array or object or null - The data that is returned by the API.

### 200 OK

The `200 OK` is a standard response for successful HTTP requests. The `data` field will contain the requested data depending on the endpoint.

This is the example of a successful response for get a song:

```json
{
    "status": "success",
    "status_code": 200,
    "message": "OK",
    "data": {
        "id": 1,
        "title": "Sugar",
        "artist": "Maroon 5",
        "genre": "Pop",
        "duration": 216,
        "year": 2020,
        "album_id": 1,
    }
}
```

### 201 Created

The `201 Created` is a standard response for successful HTTP requests that result in the creation of a resource. The `data` field will contain the created resource depending on the endpoint.

This is the example of a successful response for creating a song:

```json
{
    "status": "success",
    "status_code": 201,
    "message": "Created",
    "data": {
        "id": 1,
        "title": "Sugar",
        "artist": "Maroon 5",
        "genre": "Pop",
        "duration": 216,
        "year": 2020,
        "album_id": 1,
    }
}
```

### 400 Bad Request

The `400 Bad Request` response is sent when the request is malformed. The `message` field will contain the error messages.

This is the example of a bad request response:

```json
{
    "status": "fail",
    "status_code": 400,
    "message": [
        "The email field is required.",
        "The password field is required."
    ]
}
```

### 401 Unauthorized

The `401 Unauthorized` response is sent when the request requires authentication. The `message` field will contain the error message.

This is the example of an unauthorized response:

```json
{
    "status": "fail",
    "status_code": 401,
    "message": "Unauthorized"
}
```

### 403 Forbidden

The `403 Forbidden` response is sent when the authenticated user does not have the required permissions. The `message` field will contain the error message.

This is the example of a forbidden response:

```json
{
    "status": "fail",
    "status_code": 403,
    "message": "Forbidden"
}
```

### 404 Not Found

The `404 Not Found` response is sent when the requested resource is not found. The `message` field will contain the error message.

This is the example of a not found response:

```json
{
    "status": "fail",
    "status_code": 404,
    "message": "Not Found"
}
```

### 405 Method Not Allowed

The `405 Method Not Allowed` response is sent when the requested HTTP method is not supported by the endpoint. The `message` field will contain the error message.

This is the example of a method not allowed response:

```json
{
    "status": "fail",
    "status_code": 405,
    "message": "Method Not Allowed"
}
```

### 500 Internal Server Error

The `500 Internal Server Error` response is sent when the server encounters an unexpected condition that prevents it from fulfilling the request. The `message` field will contain the error message.

This is the example of an internal server error response:

```json
{
    "status": "fail",
    "status_code": 500,
    "message": "Internal Server Error"
}
```

## Authentication

### Login

Login to the application and get the token.

**Request**

---

```http
POST /login
```

Body:

- **email**: string (required) - The email of the user.
- **password**: string (required) - The password of the user.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `Login successful`.
- **data**: object - The data of the response.
  - **access_token**: string - The token that you need to send with every request to the API.
  - **token_type**: string - The type of the token. It will be `Bearer`.
  - **expires_at**: string - The expiration date of the token. It will be in `Y-m-d H:i:s` format. Example: `2021-01-01 00:00:00`.

> **Note**
>
> You need to send the access token with every request to the API. You can do this by adding `Authorization` header to your request. The value of the header should be `Bearer <access_token>`.

### Logout

Logout from the application.

**Request**

---

```http
POST /logout
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

**Response**

---

Body:

- **status**: string - The status of the response. It will be `success`.
- **status_code**: integer - The status code of the response. It will be `200`.
- **message**: string - The message of the response. It will be `Logout successful`.
- **data**: null - The data of the response.

## Albums

### Get Albums

Get all albums or search for albums by name.

**Request**

---

```http
GET /albums
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Query:

- **name**: string - The name of the album to search for.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `OK`.
- **data**: array of object - The albums data.
  - **id**: integer - The ID of the album.
  - **name**: string - The name of the album.
  - **year**: integer - The year of the album.

### Get Album

Get an album.

**Request**

-------

```http
GET /albums/{id}
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Parameters:

- **id**: integer (required) - The ID of the album.


**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `OK`.
- **data**: object - The album data.
  - **id**: integer - The ID of the album.
  - **name**: string - The name of the album.
  - **year**: integer - The year of the album.

### Add Album

Add an album.

**Request**

---

```http
POST /albums
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Body:

- **name**: string (required) - The name of the album.
- **year**: integer (required) - The year of the album.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `201`.
- **message**: string - It will be `Created`.
- **data**: object - The album data.
  - **id**: integer - The ID of the album.
  - **name**: string - The name of the album.
  - **year**: integer - The year of the album.

### Update Album

Update an album.

**Request**

---

```http
PATCH /albums/{id}
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Parameters:

- **id**: integer (required) - The ID of the album.

Body:

- **name**: string - The new name of the album.
- **year**: integer - The new year of the album.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `Updated`.
- **data**: object - The album data.
  - **id**: integer - The ID of the album.
  - **name**: string - The name of the album.
  - **year**: integer - The year of the album.

### Delete Album

Delete an album.

**Request**

---

```http
DELETE /albums/{id}
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Parameters:

- **id**: integer (required) - The ID of the album.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `Deleted`.
- **data**: null - The data of the response.

## Songs

### Get Songs

Get all songs or search for songs by title.

**Request**

---

```http
GET /songs
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Query:

- **title**: string - The title of the song to search for.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `OK`.
- **data**: array of object - The songs data.
  - **id**: integer - The ID of the song.
  - **title**: string - The title of the song.
  - **artist**: string - The artist of the song.
  - **genre**: string - The genre of the song.
  - **duration**: integer - The duration of the song in seconds.
  - **year**: integer - The year of the song.
  - **album_id**: integer or null - The ID of the album that the song belongs to. It will be `null` if the song doesn't belong to any album.

### Get Song

Get a song.

**Request**

---

```http
GET /songs/{id}
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Parameters:

- **id**: integer (required) - The ID of the song.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `OK`.
- **data**: object - The song data.
  - **id**: integer - The ID of the song.
  - **title**: string - The title of the song.
  - **artist**: string - The artist of the song.
  - **genre**: string - The genre of the song.
  - **duration**: integer - The duration of the song in seconds.
  - **year**: integer - The year of the song.
  - **album_id**: integer or null - The ID of the album that the song belongs to. It will be `null` if the song doesn't belong to any album.

### Add Song

Add a song.

**Request**

---

```http
POST /songs
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Body:

- **title**: string (required) - The title of the song.
- **artist**: string (required) - The artist of the song.
- **genre**: string (required) - The genre of the song.
- **duration**: integer (required) - The duration of the song in seconds.
- **year**: integer (required) - The year of the song.
- **album_id**: integer - The ID of the album that the song belongs to.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `201`.
- **message**: string - It will be `Created`.
- **data**: object - The song data.
  - **id**: integer - The ID of the song.
  - **title**: string - The title of the song.
  - **artist**: string - The artist of the song.
  - **genre**: string - The genre of the song.
  - **duration**: integer - The duration of the song in seconds.
  - **year**: integer - The year of the song.
  - **album_id**: integer or null - The ID of the album that the song belongs to. It will be `null` if the song doesn't belong to any album.

### Update Song

Update a song.

**Request**

---

```http
PATCH /songs/{id}
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Parameters:

- **id**: integer (required) - The ID of the song.

Body:

- **title**: string - The new title of the song.
- **artist**: string - The new artist of the song.
- **genre**: string - The new genre of the song.
- **duration**: integer - The new duration of the song in seconds.
- **year**: integer - The new year of the song.
- **album_id**: integer - The new ID of the album that the song belongs to.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `Updated`.
- **data**: object - The song data.
  - **id**: integer - The ID of the song.
  - **title**: string - The title of the song.
  - **artist**: string - The artist of the song.
  - **genre**: string - The genre of the song.
  - **duration**: integer - The duration of the song in seconds.
  - **year**: integer - The year of the song.
  - **album_id**: integer or null - The ID of the album that the song belongs to. It will be `null` if the song doesn't belong to any album.

### Delete Song

Delete a song.

**Request**

---

```http
DELETE /songs/{id}
```

Header:

- **Authorization**: string (required) - The `access_token` that you received from the [login](#login) endpoint.

Parameters:

- **id**: integer (required) - The ID of the song.

**Response**

---

Body:

- **status**: string - It will be `success`.
- **status_code**: integer - It will be `200`.
- **message**: string - It will be `Deleted`.
- **data**: null - The data of the response.
