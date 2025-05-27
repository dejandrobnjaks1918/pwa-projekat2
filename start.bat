@echo off

IF NOT EXIST vendor (
    call composer install
)

call php artisan migrate --seed
call php artisan storage:link

IF NOT EXIST node_modules (
    call npm install
)

call npm run build

php artisan serve
START http://localhost:8000
