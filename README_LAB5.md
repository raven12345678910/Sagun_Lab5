# Laboratory Exercise No. 5 - LavaLust CRUD with Authentication

This project was prepared from the supplied LavaLust starter project for the laboratory activity.

## Features
- Session-based login authentication
- Protected product management pages
- Create product
- Read/display all products
- Update product
- Delete product
- Aiven MySQL-compatible database configuration
- Render-compatible Dockerfile

## Routes
- `/login`
- `/login/authenticate`
- `/logout`
- `/products`
- `/products/create`
- `/products/edit/{id}`
- `/products/delete/{id}`

## Database
Run `database.sql` in the Aiven MySQL database. The supplied LavaLust project already contains a `users` migration; create that table before testing login if it does not exist yet.

For testing, create a user whose password is stored with PHP `password_hash()`.

## Environment variables
Set these in Render (do not commit real credentials):
- `DB_DRIVER=mysql`
- `DB_HOST`
- `DB_PORT`
- `DB_USER`
- `DB_PASSWORD`
- `DB_NAME`
- `DB_CHARSET=utf8mb4`
- `APP_KEY`

The `.env` file included in this prepared copy contains placeholders only.
