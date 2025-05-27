@echo off

IF NOT EXIST vendor (
    echo Instalacija composer paketa...
    composer install
)

echo Pokretanje migracija i seedova...
php artisan migrate --seed

echo Kreiranje storage linka...
php artisan storage:link

echo Laravel server se pokreće na http://localhost:8000
php artisan serve
