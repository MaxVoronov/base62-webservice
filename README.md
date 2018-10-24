# Base62 Web Сервис

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
