# Новостной сайт на Laravel

Учебный проект — лабораторные работы 1–4 по теме «Веб-сайт».

## Требования

- PHP 8.2+
- Composer
- PostgreSQL (порт 5432)
- Расширения PHP: fileinfo, pdo_pgsql, pgsql, mbstring, openssl, tokenizer, xml, ctype, bcmath, curl, zip

## Установка

1. Клонировать репозиторий:
   ```bash
   git clone https://github.com/Tashoi67/news-site-laravel.git project
   cd project
Установить зависимости:

bash
composer install
Создать базу данных Rusik в pgAdmin (пароль пользователя postgres: qwerty123).

Запустить миграции и сидеры:

bash
php artisan migrate:fresh --seed
Запустить сервер:

bash
php artisan serve


Тестовые аккаунты
Логин	Пароль	Роль
admin	123456	Администратор
journalist	123456	Журналист
user	123456	Пользователь\











git clone https://github.com/Tashoi67/news-site-laravel.git project
cd project
composer install
php artisan migrate:fresh --seed
php artisan serve
