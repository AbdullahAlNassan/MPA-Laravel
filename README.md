# MPA Jukebox (Laravel 8)

Multi Page Application met Laravel. CRUD voor Books + Genres, zoeken/filteren/sorteren, Blade templates, Eloquent ORM, migrations & seeders.

## Vereisten
- PHP 8.x, Composer
- MySQL (XAMPP)
- Node (optioneel voor front-end assets)

## Installatie (lokaal)
```bash
# 1) Dependencies
composer install

# 2) Environment
cp .env.example .env
php artisan key:generate

# 3) Database instellen (.env)
# DB_DATABASE=jukebox
# DB_USERNAME=root
# DB_PASSWORD= (leeg op XAMPP)
# DB_PORT=3306 of jouw poort

# 4) Migrate + seed
php artisan migrate --seed

# 5) (Optioneel) Storage link als je uploads gebruikt
php artisan storage:link
