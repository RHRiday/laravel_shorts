# About this project
Small [Laravel](https://laravel.com/) projects while learning the framework.


## Blog features
- View blogs as a guest.
- Register & Login as an user.
- Logged user can post and view blogs.
- User can edit or delete own posts.
- Post can be filtered by tag or user that posted.
- Duplication will be validated.
- Feedback on validation error.
- Blog pagination.

### What I learned new
- Store files.
- Migrations in Laravel applications.
- Authenticate users before performing an action.
- Editable and dynamic `<option>`.
- Rendering 404 page.
- Pagination according to data.
- Laravel Mix.
- Run front-end assets in Laravel applications.
- Creating slugs.
- Deploying Laravel apps to heroku
    - Create a `Procfile`
    - Write `web: vendor/bin/heroku-php-apache2 public` in the Procfile
    - Add all the `env` variables ![#f03c15](https://via.placeholder.com/15/f03c15/000000?text=+) `APP_DEBUG`, `APP_KEY`, `APP_NAME`, `DB_$vars` are compulsory.
    - Make sure to set `buildpacks` in this order (use command `heroku buildpacks add $BUILDPACK_NAME`)
        > 1. heroku/node
        > 2. heroku/php 
    - Run `heroku run php artisan migrate -a $APP_NAME` for database migration.
    - Run `heroku run npm i -a $APP_NAME` for installing node packages.

### Technologies used
- Laravel
- Bootstrap
- FontAwesome
- FreeMySqlHosting

## FAQ features
1. Admin Login
    - Dashboard
    - Manage FAQs (CRUD)
    - Drag & Drop to sort quickly
    - Verification message on every action
2. Visitors view
    - Search any FAQ instantly
    - Accordion FAQ dropdown

### Migrations
> User
- name
- email
- password
- role (default: 2) `[1 => 'super-admin', 2 => 'admin']`
> FAQ
- question
- answer
- priority
- publication_status `[0 => Unpublished, 1 => Published]`

### Technologies used
- Laravel [v8.4]
- JavaScript
    - jQuery [v3.2.1]
    - DataTable [v1.10.25]
    - jQuery UI [v1.12.1]
    - TypedJS [v2.0.12]
    - metisMenu [v3.3]
    - alertifyJs [v1.13]
- Bootstrap `['home' => v5.0.2, 'admin' => v3.3.7]`
- FontAwesome [v4.7]

### What I learned new
- Laravel components
- Laravel custom error message
    [in `app\Exeptions\Handler.php` add the following code]
    ```
        protected function unauthenticated($request, AuthenticationException $exception)
        {
            return $request->expectsJson()
                ? response()->json(['message' => $exception->getMessage()], 401)
                : redirect()->guest(route('login'))->with('message', 'You need to login first');
        }
    ```

## Getting Started
> use following credentials to login:

|**Email**       | **Password** |
|----------------|--------------|
|pondit@admin.com|ponditadmin   |
