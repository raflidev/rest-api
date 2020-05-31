# rest-api
laravel rest api + vue 3
## Instalation
use composer and npm for installing

1. Do the following commands for installing
```bash
git clone https://github.com/raflidev/rest-api.git
cd rest-api
composer install
npm install
copy .env.example .env
php artisan key:generate
```
2. Create database and import **rest-api.db**
3. Setting database name, username, and password in your .env file
4. Do the following instructions if you're done setting database in .env
```bash
php artisan config:cache
```

## To run the application
```bash
php artisan serve
npm run serve
```
  
## License
[MIT](https://choosealicense.com/licenses/mit/)
