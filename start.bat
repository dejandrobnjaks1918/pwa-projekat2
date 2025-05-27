@echo off

IF NOT EXIST vendor (
    composer install
)

IF NOT EXIST .env (
    copy .env.example .env
)

php artisan migrate --seed
php artisan storage:link

IF NOT EXIST node_modules (
    npm install
)

npm run build

php artisan serve
start http://localhost:8000
