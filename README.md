# Тестовое задание для Roistat

### Стек технологий

1. Laravel
2. PostgreSQL
3. Boostrap
4. AmoCRM Library

### Запуск

Для запуска приложения необходимо наличие composer и npm

1. Cкачать все необходимые пакеты

```
composer install
```

```
npm install
```

2. Скопировать .env.example в .env и прописать подключение к БД и данные для интеграции

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_test
DB_USERNAME=root
DB_PASSWORD=

#id интеграции
CLIENT_ID=""
#секретный ключ
CLIENT_SECRET=""
BASE_DOMAIN=test.amocrm.ru
CLIENT_REDIRECT_URI=""
CODE=""

```

3. Создать БД (в ней хранятся токены)

```
php artisan migrate
```

4. Выполнить

```
npm run dev
```

```
php artisan serve
```

5. Перейти на http://127.0.0.1:8000/ (если не изменяли настройки)

### Условие

Создать форму с полями: email, имя, телефон, цена.
Данные из формы передавать в CRM в виде сделки с прикрепленном в ней контактом.
