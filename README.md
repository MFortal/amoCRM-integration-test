# Тестовое задание для Roistat

### Стек технологий

1. Laravel
2. PostgreSQL
3. Boostrap
4. AmoCRM Library
    - amocrm-api-php
    - amocrm-oauth-client
5. Docker

### Запуск

Для запуска приложения необходим docker и (опционально) улитита make

0. Создать в амоМаркете внешнюю интеграцию

1. Сбидлить контейнеры

```
make build
```

2. Скопировать .env.example в .env и прописать подключение к БД и данные для интеграции

```
DB_CONNECTION=mysql
DB_HOST=db
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
#код авторизации
AUTHORIZATION_CODE=""
```

3. Запустить контейнеры
```
make run
```

4. Установить зависимости

```
make install
```

5. Накатить миграции в БД (в ней хранятся токены)

```
make migrate_run
```

6. Перейти на http://127.0.0.1:8000/ (если не изменяли настройки)
   6.1. Если возникает ошибка "permission denied" на папку storage/, то неободимо права для /storage
```
make php
```
```
sudo chmod 777 storage/ -R
```

### Условие

Создать форму с полями: email, имя, телефон, цена.
Данные из формы передавать в CRM в виде сделки с прикрепленном в ней контактом.

\*Созданные сделки попадают в неразобранное
\*В цене нужно указывать только цифры, в поле email - валидный по dns email, минимальная длина телефона - 8 символов (стоит валидация, файл - /app/Http/Requests/SendFormRequest)
