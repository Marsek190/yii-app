## Установка
## Бэкенд
Создать бд employees:
```mysql
CREATE DATABASE EMPLOYEES;
SHOW DATABASES;
```

```bash
$ cd yii-app
$ composer update
$ php yii migrate
$ php yii run serve --port 8000
```

## Фронтэнд
```bash
$ cd yii-app/frontend
$ npm i
```

## Запуск
```bash
$ cd yii-app/frontend
$ npm run serve -- --port 3000
```
В случае успешной установки и запуска в браузере по адресу http://localhost:3000/users отобразится начальная страница
