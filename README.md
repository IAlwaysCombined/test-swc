# test-swc

## Клонируем .env файл
```
cp .env.example .env
```
## Генерируем токен приложения
```
php artisan key:generate
```
## Генерируем токен jwt
```
php artisan jwt:secret
```
## Добавляем alias
```
alias sail='bash vendor/bin/sail'
```

## Установка зависимостей
```
composer install
```

## Поднимаем докер
```
sail up
```

## Выполняем миграции
```
docker exec -it <CONTAINER_ID> php artisan migrate
```

## Поднимаем докер
```
sail up
```

## Кладем докер
```
sail down
```
