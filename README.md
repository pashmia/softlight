## Установка

Клонируйте репозиторий:

```
git clone <репозиторий>
docker-compose up -d
```

## Примеры запросов и ответов
### - Аутентификация
Запрос на логин
```

curl -X POST http://localhost/api/login -d '{
  "email": "admin@admin.com",
  "password": "password"
}'
```

Ответ
```json
{
  "token": "JWT_TOKEN"
}
```

### - CRUD для продуктов
Создание продукта
```
curl -X POST http://localhost/api/products -H "Authorization: Bearer JWT_TOKEN" -d '{
  "name": "Продукт",
  "description": "Описание продукта",
  "category_id": 1,
  "country_id": 1,
  "status_id": 1
}'
```

Получение списка продуктов
```
curl -X GET http://localhost/api/products -H "Authorization: Bearer JWT_TOKEN"
```
Получение продукта по ID
```
curl -X GET http://localhost/api/products/1 -H "Authorization: Bearer JWT_TOKEN"
```
Обновление продкута по ID
```
curl -X PUT http://localhost/api/products/1 -H "Authorization: Bearer JWT_TOKEN" -d '{
"name": "Обновленный продукт",
"description": "Новое описание продукта",
"category_id": 2,
"country_id": 1,
"status_id": 2
}'
```

Частичное обновление продукта
```
curl -X PATCH http://localhost/api/products/1 -H "Authorization: Bearer JWT_TOKEN" -d '{
"description": "Обновленное описание"
}'
```

Получение списка продуктов со статусом approved
```
curl -X GET http://localhost/api/products/dropdown -H "Authorization: Bearer JWT_TOKEN"
```

Пример ответов
```json
{
    "id": 1,
    "name": "Продукт",
    "description": "Описание продукта",
    "user": {
        "id": 1,
        "name": "Администратор"
    },
    "category": "Категория 1",
    "country": "Страна 1",
    "status": "approved",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
}
```
