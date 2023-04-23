<h2>Бизнес модель - кафе</h2>

<span style="color:orange"> *после установки проекта применить миграции.</span>

Особенности:

Повара готовят конкретные блюда
меню формируется на основе готовых блюд
посетитель заказывает блюда из меню
Сделать:
Разработать на php :

- Физическая модель данных (в таблицах использовать минимум аттрибутов)
- Метод REST API открытия чека

```
curl --location --request POST 'cafe.local/orders' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "test",
    "user": "test"
}'
  ```

- Метод REST API добавление позиции из меню в чек

```
curl --location --request POST 'cafe.local/order-items' \
--header 'Content-Type: application/json' \
--data-raw '{
    "order_id": 1,
    "menu_id": 1,
    "quantity": 1
}'
```

- Метод REST API получения списка популярных поваров за период ( критерий популярности - количество заказанных блюд )

```
curl --location --request GET 'http://cafe.local/chefs/popular?start=2022-01-12&end=2023-12-12&limit=5'
```

Нужно использовать yii2
