<h1>Migrate data - Тестовое задание - Титаренко Михал</h1>

<h3>Если будут какие-то вопросы, требующие пояснения - я на связи!</h3>

<h2>Как запускать</h2>

1. В терминале переходим в каталог с проектом
2. Выполняем composer install
2. php artisan customer:migrate storage/random.csv --first-row-header
3. База лежит в database/database.sqlite

<h2>По команде</h2>

php artisan customer:migrate {filename} {--first-row-header}

filename - путь к файлу<br />
--first-row-header - опция, что первая строка является заголовком (обрабатываться не будет)

<h2>Пояснения</h2>

- Использовал sqlite для простоты взаимодействия, но можно подвязать что захотите.
В этом случае после установки параметров в .env понадобится выполнить php artisan migrate.

- Залил на git и .env файл чисто чтобы не надо было вам создавать. Так вообще-то делать низя=)
