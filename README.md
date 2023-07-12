# Admin-Kit Core Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibecsystems/admin-kit-core.svg?style=flat-square)](https://packagist.org/packages/ibecsystems/admin-kit-core)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/IBEC-BOX/admin-kit-core/run-tests.yml?branch=2.x&label=tests&style=flat-square)](https://github.com/IBEC-BOX/admin-kit-core/actions?query=workflow:run-tests+branch:2.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/IBEC-BOX/admin-kit-core/fix-php-code-style-issues.yml?branch=2.x&label=code%20style&style=flat-square)](https://github.com/IBEC-BOX/admin-kit-core/actions?query=workflow:"Fix+PHP+code+style+issues"+branch:2.x)
[![Total Downloads](https://img.shields.io/packagist/dt/ibecsystems/admin-kit-core.svg?style=flat-square)](https://packagist.org/packages/ibecsystems/admin-kit-core)

Пакет имеет готовые модули для быстрого старта проекта. 
Использует админ панель Filament, и содержит готовые API эндпоинты, что и служит улучшением и ускорением разработки админ панелей.

На текущий момент созданы следующие пакеты для Admin Kit:

| Название   | Ссылка                                           | Готовность |
|------------|--------------------------------------------------|------------|
| Core       | https://github.com/IBEC-BOX/admin-kit-core       | 90%        |
| Users      | https://github.com/IBEC-BOX/admin-kit-core       | 100%       |
| Roles      | https://github.com/IBEC-BOX/admin-kit-core       | 100%       |
| Navigation | https://github.com/IBEC-BOX/admin-kit-navigation | 100%       |
| SEO        | https://github.com/IBEC-BOX/admin-kit-seo        | 100%       |
| Articles   | https://github.com/IBEC-BOX/admin-kit-articles   | 100%       |
| Pages      | https://github.com/IBEC-BOX/admin-kit-pages      | 50%        |
| Documents  | https://github.com/IBEC-BOX/admin-kit-articles   | 50%        |
| Banners    | https://github.com/IBEC-BOX/admin-kit-banners    | 10%        |
| FAQs       | https://github.com/IBEC-BOX/admin-kit-faqs       | 10%        |
| Polls      | https://github.com/IBEC-BOX/admin-kit-polls      | 10%        |
| Vacancies  | https://github.com/IBEC-BOX/admin-kit-vacancies  | 10%        |
| Porto      | https://github.com/IBEC-BOX/laravel-porto        | 90%        |

И использует следующие пакеты Laravel и Filament:

| Название              | Composer пакет                              |
|-----------------------|---------------------------------------------|
| Laravel               | laravel/framework                           |
| Package tools         | spatie/laravel-package-tools                |
| Laravel Translatable  | spatie/laravel-translatable                 |
| Laravel Query Builder | spatie/laravel-query-builder                |
| Laravel API Paginate  | spatie/laravel-json-api-paginate            |
| Laravel Data          | spatie/laravel-data                         |
| Laravel Sluggable     | cviebrock/eloquent-sluggable                |
| Filament              | filament/filament                           |
| Filament Permissions  | bezhansalleh/filament-shield                |
| Filament Impersonate  | stechstudio/filament-impersonate            |

## Installation

Установку производить на проекте Laravel, с настроенной базой данных

Установить пакет
```shell
composer require ibecsystems/admin-kit-core
```

Запустить команду настройки пакета
```shell
php artisan admin-kit:install
```

Создать пользователя
```shell
php artisan make:filament-user
```

## Usage

Переходите по ссылке `/admin`, введите логин и пароль, и вы попали в админ панель.
 
Полная документация по пакету находится в файле [Documentation](Documentation.md).

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
