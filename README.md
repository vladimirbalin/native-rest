## Тестовое задание

### Описание:

Реализовать методы REST API для работы с пользователями:

1. Создание пользователя
2. Обновление информации пользователя
3. Удаление пользователя
4. Авторизация пользователя
5. Получить информацию о пользователе
6. В файле README.md описать реализованные методы

## REST API для работы с пользователями на нативном PHP

### Структура проекта:

```
core                                -- mvc framework
├── Application.php
├── Controller.php
├── Db.php
├── Request.php
├── Response.php
└── Router.php
app                                 -- REST API реализация
├── Controllers
│   └── User
│       ├── AuthController.php
│       ├── BaseController.php
│       ├── CreateController.php
│       ├── DeleteController.php
│       ├── UpdateController.php
│       └── UserInfo.php
├── Middlewares
│   └── NotAuthorized.php
├── Repositories
│   └── UserRepository.php
└── Services
│   └── UserService.php
└── index.php
```

### 1. Создать пользователя

```http
  POST /user
```

+ Body
    + (json) **Required**

Например:

``` 
POST /user
{
    "username": "name",
    "password": "123",
    "password_confirm": "123"
}
```

Возвращает JSON вида:

```
Response 201
{
  "user": 
    {
        "username":"username",
        "token":"string",
    }
}
```

`Response 400`, `Response 401`, `Response 404`.

### 2. Обновить информацию о пользователе

```http
  PUT /user
```

+ Parameter
    + id (int) **Required**. Id обновляемого пользователя
+ Header
    + Authorization (Bearer) **Required**. token зарегестрированного пользователя
+ Body
    + (json) **Required**

Например:

```
PUT /user?id=4
Authorization: Bearer abc

{
    "username": "name",
    "password": "123",
    "password_confirm": "123"
}
```

Возвращает

```
Response 200:
{
  "user": 
    {
      "username":"username",
      "token":"string",
    }
}
```

`Response 400`, `Response 401`, `Response 404`.

### 3. Удалить пользователя

```http
  DELETE /user
```

+ Parameter
    + id (int) **Required**. Id удаляемого пользователя
+ Header
    + Authorization (Bearer) **Required**. token зарегестрированного пользователя

Например:

```
DELETE /user?id=4
Authorization: Bearer abc
```

Возвращает `Response 204` `Response 400` `Response 401` `Response 404`

### 4. Получить информацию о пользователе

```http
  GET /user
```

+ Parameter
    + id (int) **Required**. Id получаемого пользователя
+ Header
    + Authorization (Bearer) **Required**. token зарегестрированного пользователя

Например:

```http
GET /user?id=1 
Authorization: Bearer abc
```

Возвращает JSON вида:

```
Response 200
{
  "user": 
      {
        "username":"username",
        "token":"string",
      }
}
```

`Response 400`, `Response 401`, `Response 404`.