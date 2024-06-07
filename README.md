# Laniakea Demo

This is demo Laravel 11 application that uses `laniakea/laniakea` package.

[Learn more about Laniakea](https://laniakea.zurbaev.com).

## Requirements

This application requries PHP 8.2+ and Node 18+. It also uses sqlite database with demo content.

## Installation

```bash
# Clone the repository
git clone https://github.com/tzurbaev/laniakea-demo.git

# Install dependencies
cd laniakea-demo
composer install
npm install

# Build assets
npm run build # or start development server with `npm run dev`

# Copy .env.example to .env
cp .env.example .env

# Create empty sqlite database
touch database/database.sqlite

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Start built-in server
php artisan serve # or create Valet link with `valet link`
```

## What's inside

This is a books database application where you can create authors, genres, and books.

It uses all Laniakea features, including [resources](https://laniakea.zurbaev.com/resources.html),
[repositories](https://laniakea.zurbaev.com/repositories.html), [API versions](https://laniakea.zurbaev.com/resources/versions.html),
[model settings](https://laniakea.zurbaev.com/settings.html), and [forms](https://laniakea.zurbaev.com/forms.html).

## API

This application has a simple API that allows you to paginate, create, and show app resources (authors, books, and genres). 
Books API also supports editing.

All API routes are described inside `routes/api.php` file. It contains two API versions (`v1` and `v2`) that are
available at `http://localhost:8000/api/v1` and `http://localhost:8000/api/v2` respectively.

## Filters

Authors, Genres, and Books resources all support several filters. Check respective classes (inside `app/Resources` directory)
to see available filters.

## Directory structure

All application code is located inside `app` directory. It contains the following subdirectories:

- `Actions` – contains actions that are used in controllers (create or update models);
- `Enums` – contains enums that are used in application;
- `Exceptions` – contains custom [exceptions](https://laniakea.zurbaev.com/exceptions.html);
- `Forms` – contains [form](https://laniakea.zurbaev.com/forms.html) classes that are used on frontend;
- `Http` – contains controllers and requests;
- `Interfaces` – contains interfaces that are used for [API versioning](https://laniakea.zurbaev.com/resources/versions.html);
- `Models` – contains Eloquent models;
- `Repositories` – contains Laniakea [repositories](https://laniakea.zurbaev.com/repositories.html) and
[criteria](https://laniakea.zurbaev.com/repositories/criteria.html);
- `Resources` – contains Laniakea [resources](https://laniakea.zurbaev.com/resources.html),
[filters](https://laniakea.zurbaev.com/resources/filters.html), and [resource registrars](https://laniakea.zurbaev.com/resources/registrars.html);
- `Settings` – contains Laniakea [model settings](https://laniakea.zurbaev.com/settings.html);
- `Transformers` – contains transformers that are used in APIs
([Fractal](https://fractal.thephpleague.com) & [`spatie/laravel-fractal`](https://github.com/spatie/laravel-fractal));
- `ViewComposers` – contains view composers that are used in Blade templates.

## Frontend

Frontend is powered by simple [Vue 3](https://vuejs.org) application with [Tailwind CSS](https://tailwindcss.com) styles and a few
[Tailwind UI](https://tailwindui.com) components.

Check `resources/js` directory to see all frontend code.

## Tests

This application has tests (Pest) that cover versioned API routes. You can run them with the following command:

```bash
php artisan test
```

## Commits history

This repository contains a history of commits that show how the application was built step by step. You can check them to see
how Laniakea features were implemented and/or refactored.

## License

The MIT License (MIT). Please see [License File](./LICENSE.md) for more information.
