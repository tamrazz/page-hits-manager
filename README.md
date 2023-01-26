# HTTP-API Сервис подсчета просмотров страницы

## Постановка от бизнеса

Нужно знать сколько было просмотров страниц за конкретный период для анализа трафика.

## Задача

Нужно написать API-сервис для js-клиента, который будет хранить и выводить кол-во просмотров для страниц.

Полные пути к эндпоинтам и их название остаются на ваше усмотрение, в задании эндпоинты указаны в качестве примера для понимания и могут быть не совсем правильные или логичные,  мы хотим узнать, как вы будете организовывать архитектуру своего сервиса.

### Сервис должен выполнять следующие функции

1. Инкремент для конкретной страницы. Пример `POST::/api/page/inrcement BODY:{"path":"/some-subpage/subpage"}`.
2. Получение кол-ва просмотров по конкретной странице за весь период. Пример `POST::/api/page/get-views/all BODY:{"path":"/another-page/path"}`. За весь период эндпоинт должен быть публичным.
3. Получение кол-ва просмотров по конкретной странице за день/неделю/месяц/год/весь период. Пример `POST::/api/page/get-views BODY:{"path":"/another-page/path", "period":"all"}`. По периодам эндпоинт должен быть закрытым.
4. Получение списка страниц с количеством просмотров за заданный период. Пример `PUT::/report/2021-01-12/to/2021-01-24`. Должен быть закрытым.

### Дополнительно
1. Ответы на получение просмотров по страницам можно кэшировать.
2. Дополнительная запись уникальных просмотров на основе ip-адреса и возможность получение информации о странице как с уникальными просмотрами, так и всех просмотров.
3. Если будут тесты, то хорошо.

Должна быть хоть какая-то понятная документация. Хоть примеры в виде curl, коллекция postman, OAS.
Должна быть инструкция по установке. Можно использовать докер, но только рабочий, пожалуйста провреяйте докер-образ при различных условиях. "У меня такая же нога и не болит" -- нас не устраивает:).

## На чём писать

- [Laravel framework](https://laravel.com/)
- PHP 8.1.* или любая другая версия с кодом совместимым с пхп8.1. Если в composer.json указано php: ">=7.3", значит все должно работать как на пхп7.3, так и на пхп 8.1
- В качестве БД mariadb 10.4(предпочтительнее), postgresql 13, sqlite(лучше не стоит, но для тестов можно:))
- В качестве провайдера кэша, что угодно: redis, memcached, файловый - , глвное делать через фасад ларавеля, чтобы работало на различных провайдерах.

**Если что-то непонятно или требует уточнения обращайтесь к нашему HR-специалисту. Мы будем уточнять задание. Если в чём-то не уверены, то тоже обращайтесь**
