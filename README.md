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
--header 'Cookie: PHPSESSID=9fa6366f8a318acf7b1c4eb1c8f55c35; _csrf=ab05d153035b4a9f7b6e229e2d10ae89c67e6417ebea2122216dcc8d8b02ae25a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%22MWwTAJjFqTi0OK3fyClLBU2hj6odYnZQ%22%3B%7D' \
--form 'name="test"' \
--form 'user="test"'
  ```

- Метод REST API добавление позиции из меню в чек

```
curl --location --request POST 'cafe.local/order-items' \
--header 'Cookie: PHPSESSID=9fa6366f8a318acf7b1c4eb1c8f55c35; _csrf=ab05d153035b4a9f7b6e229e2d10ae89c67e6417ebea2122216dcc8d8b02ae25a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%22MWwTAJjFqTi0OK3fyClLBU2hj6odYnZQ%22%3B%7D' \
--form 'order_id="1"' \
--form 'menu_id="1"' \
--form 'quantity="1"'
```

- Метод REST API получения списка популярных поваров за период ( критерий популярности - количество заказанных блюд )

```
curl --location --request GET 'http://cafe.local/chefs/popular?start=2022-01-12&end=2023-12-12&limit=2' \
--header 'Cookie: PHPSESSID=9fa6366f8a318acf7b1c4eb1c8f55c35; _csrf=ab05d153035b4a9f7b6e229e2d10ae89c67e6417ebea2122216dcc8d8b02ae25a%3A2%3A%7Bi%3A0%3Bs%3A5%3A%22_csrf%22%3Bi%3A1%3Bs%3A32%3A%22MWwTAJjFqTi0OK3fyClLBU2hj6odYnZQ%22%3B%7D'
```

Нужно использовать yii2
