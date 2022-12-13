### Package AdminKit/Core

### Installation

Установку проще делать на новом Laravel.

1. Добавить следующую строку в файле `composer.json`
```shell
"repositories": [
    {
        "type": "git", 
        "url": "https://github.com/ast21/core"
    }
]
```

2. Установить пакет
```shell
composer require admin-kit/core
```

3. Запустить команду установки пакета
```shell
php artisan admin-kit:install
```

4. Создать пользователя для админки
```shell
php artisan orchid:admin
```

### Usage

Переходите по ссылке `/admin`, введите логин и пароль, и вы попали в админ панель.