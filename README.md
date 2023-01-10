# Admin-Kit Core Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/admin-kit/core.svg?style=flat-square)](https://packagist.org/packages/admin-kit/core)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/admin-kit/core/run-tests.yml?branch=1.x&label=tests&style=flat-square)](https://github.com/admin-kit/core/actions?query=workflow%3Arun-tests+branch%3A1.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/admin-kit/core/fix-php-code-style-issues.yml?branch=1.x&label=code%20style&style=flat-square)](https://github.com/admin-kit/core/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3A1.x)
[![Total Downloads](https://img.shields.io/packagist/dt/admin-kit/core.svg?style=flat-square)](https://packagist.org/packages/admin-kit/core)

Пакет служит улучшением и ускорением разработки админ панелей.

## Installation

Установку проще делать на новом Laravel.

Установить пакет
```shell
composer require admin-kit/core
```

Запустить команду установки пакета
```shell
php artisan admin-kit:install
```

Создать пользователя для админки
```shell
php artisan orchid:admin
```

Опционально, можно кастомизировать view файлы
```bash
php artisan vendor:publish --tag="admin-kit-views"
```

## Usage

Переходите по ссылке `/admin`, введите логин и пароль, и вы попали в админ панель.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Anastas Mironov](https://github.com/ast21)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
