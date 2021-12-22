#Как запускать

1. В терминале переходим в каталог с проектом
2. Выполняем composer install
2. php artisan customer:migrate storage/random.csv --first-row-header
3. База лежит в database/database.sqlite

#По команде

php artisan customer:migrate {filename} {--first-row-header}

filename - путь к файлу

--first-row-header - опция, захватывать ли первую строку (там заголовки или нет)

#Пояснения

- Использовал sqlite для простоты взаимодействия, но можно подвязать что захотите.
В этом случае после установки параметров в .env понадобится выполнить php artisan migrate.

- Залил на git и .env файл чисто чтобы не надо было вам создавать. Так вообще-то делать низя=)

###Если будут какие-то вопросы, требующие пояснения - я на связи!
