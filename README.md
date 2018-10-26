# Base62 Web Сервис

Простой сервис для кодирования/декодирования строк в/из Base62. Базируется на библиотеке
[Amirax Base62](https://github.com/amirax/base62). Домашнее задание для урока №7
специально для курса Otus.

## Как запустить

1. Переименовать файл _.env.dist_ в _.env_. По необходимости можно изменить в нем настройки.
2. Сборка docker-образов  
   Для этого выполните команду:
   ```
   $ docker-compose build
   ```
3. Запуск контейнеров:
   ```
   $ docker-compose up -d
   ```
4. Установить зависимости приложения используя composer из контейнера:
   ```
   $ docker-compose exec phpfpm composer install -a
   ```

# Использование

После запуска web-сервис будет доступен по адресу указаному в файле _.env_ параметр APP_HOST.
Для кодирования строки в Base62 используйте адрес: _/encode?data=<your_string>_. В результате
вернется JSON ответ:
```
> http://www.base62-encoder.loc/encode?data=Hello
{"source":"Hello", "result":"5TP3P3v"}
```

Аналогичным образом работает и декодирование:
```
> http://www.base62-encoder.loc/decode?data=5TP3P3v
{"source":"5TP3P3v", "result":"Hello"}
```
