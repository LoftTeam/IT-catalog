# IT-catalog

Какие технологии используются: PHP 5.6, MYSQL, javascript, jquery, composer, phpmailer, twig.

## Функционал интернет каталога

1.Возможность пользователям регистрироваться или авторизоваться в системе.

2.Возможность оставлять заказ на товары каталога.

3.При заказе товаров администратор сайта оповещается о новом заказе по email. Также
пользователю приходит письмо о том, что его заказ получен. При каждом изменении 
статуса заказа пользователя, пользователю отсылается письмо, что статус его заказа 
изменен.

4.В каталоге реализована система поиска товаров по критериям (цена,
производитель, категория товара).

-5. Реализована система загрузки / выгрузки товаров в (из) каталога.

6.Реализована страница для связи с администрацией сайта ­ “Контакты” ­  (страница с
контактными данными, картой и формой связи и капчей).

7.Реализована простая страница с описанием сайта (О нас).

8 Реализована страница со списком товаров конкретной категории.

9.Реализована страница с описанием конкретного товара.

10. Реализована страница с описанием способов оплаты товара.

11. Реализована административная часть сайта, которая состоит из следующих
функциональных элементов​:

	a. Добавление, редактирование, удаление категорий товаров.

	b. Добавление, редактирование, удаление товаров.

	c. Обработка заказов магазина.

	d. Обработка пользователей магазина (добавление прав пользователям, ручная активация 
	аккаунта пользователя, удаление пользователей).

	-e. Выгрузка / загрузка товаров в БД по требованию.

	f. Реализована рассылка писем пользователям сайта по определенным критериям ­
	админам, покупателям, новым пользователям и т.п. 

## Установка

1. Клонируем проект с репозитория
```sh
git clone https://github.com/LoftTeam/IT-catalog.git
```
	1.1 ВЫрезаем все файлы из папки "IT-catalog" и помещаем в корневой каталог.
	1.2 удаляем папку "IT-catalog".

2. В корневой папке с помощью консоли установить composer со всеми зависимостями composer.json
```sh
composer install
```
3. В файле app/config/config.ini изменить парамметры доступа на свои.
4. Папка с БД  находится в /tmp

## Доступ к админке
	admin@bk.ru
	adminpass

## Для разработки
	
После создания дополнительных файлов на пример "IndexController.php" или "IndexModel.php" обязательно обновляем composer командой
```sh
composer dump-autoload
```