# Admin-Kit Core Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibecsystems/admin-kit-core.svg?style=flat-square)](https://packagist.org/packages/ibecsystems/admin-kit-core)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/IBEC-BOX/admin-kit-core/run-tests.yml?branch=2.x&label=tests&style=flat-square)](https://github.com/IBEC-BOX/admin-kit-core/actions?query=workflow:run-tests+branch:2.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/IBEC-BOX/admin-kit-core/fix-php-code-style-issues.yml?branch=2.x&label=code%20style&style=flat-square)](https://github.com/IBEC-BOX/admin-kit-core/actions?query=workflow:"Fix+PHP+code+style+issues"+branch:2.x)
[![Total Downloads](https://img.shields.io/packagist/dt/ibecsystems/admin-kit-core.svg?style=flat-square)](https://packagist.org/packages/ibecsystems/admin-kit-core)

Пакет имеет готовые модули для быстрого старта проекта. 
Использует админ панель Filament, и содержит готовые API эндпоинты, что и служит улучшением и ускорением разработки админ панелей.

## Структура пакетов Admin Kit

На текущий момент созданы следующие пакеты для Admin Kit:

| Название                      | Код           | Тип                      | Описание                                                                                                                                                                                                               | Ссылка                                           | Готовность                 |
|-------------------------------|---------------|--------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------|----------------------------|
| Ядро                          | Core          | Базовый пакет            | Пакет содержит идеологию, настройки по умолчанию, кастомные поля и модуль Users                                                                                                                                        | https://github.com/IBEC-BOX/admin-kit-core       | Готово :white_check_mark:  |
| Пользователи                  | Users         | -                        | Находится в составе пакета Core, незаменимый модуль Core пакета                                                                                                                                                        | https://github.com/IBEC-BOX/admin-kit-core       | Готово :white_check_mark:  |
| Роли                          | Roles         | Внешний пакет            | Используется пакет [Filament Shield](https://github.com/bezhanSalleh/filament-shield), настройки по умолчанию интегрированы с в пакет Core                                                                             | https://github.com/bezhanSalleh/filament-shield  | Готово :white_check_mark:  |
| Меню                          | Navigation    | Полноценный пакет (Форк) | Пакет для создания элементов меню. Сделан форк внешнего пакета [Filament Navigation](https://github.com/ryangjchandler/filament-navigation), который кастомизирован под идеологию Admin Kit. Доступна мультиязычность. | https://github.com/IBEC-BOX/admin-kit-navigation | Готово :white_check_mark:  |
| Новости                       | Articles      | Полноценный пакет        | Пакет для создания новостей. Доступна мультиязычность.                                                                                                                                                                 | https://github.com/IBEC-BOX/admin-kit-articles   | Готово :white_check_mark:  |
| Страницы                      | Pages         | Полноценный пакет        | В разработке. Пакет для создания WYSIWYG страниц. Доступна мультиязычность.                                                                                                                                            | https://github.com/IBEC-BOX/admin-kit-pages      | 50% :large_orange_diamond: |
| Документы                     | Documents     | Полноценный пакет        | В разработке. Пакет для загрузки документов(файлов). Доступна мультиязычность.                                                                                                                                         | https://github.com/IBEC-BOX/admin-kit-documents  | 50% :large_orange_diamond: |
| Локализация                   | Localizations | Полноценный пакет        | В разработке. Пакет для создания переводов для фронт разработчиков. Доступна мультиязычность.                                                                                                                          | Not initialized                                  | 50% :large_orange_diamond: |
| Баннеры                       | Banners       | Полноценный пакет        | На стадии идеи. Пакет для создания Баннеров. Доступна мультиязычность.                                                                                                                                                 | https://github.com/IBEC-BOX/admin-kit-banners    | 10% :o:                    |
| Частые вопросы                | FAQs          | Полноценный пакет        | На стадии идеи. Пакет для создания Частых Вопросов. Доступна мультиязычность.                                                                                                                                          | https://github.com/IBEC-BOX/admin-kit-faqs       | 10% :o:                    |
| Опросы                        | Polls         | Полноценный пакет        | На стадии идеи. Пакет для создания Опросов.                                                                                                                                                                            | https://github.com/IBEC-BOX/admin-kit-polls      | 10% :o:                    |
| Вакансии                      | Vacancies     | Полноценный пакет        | На стадии идеи. Пакет для создания Вакансий. Дополнительно содержит города, должности, форму для заявок.                                                                                                               | https://github.com/IBEC-BOX/admin-kit-vacancies  | 10% :o:                    |
| Галерея                       | Gallery       | Полноценный пакет        | На стадии идеи. Пакет для создания Фото/Видео галереи.                                                                                                                                                                 | Not initialized                                  | 0% :o:                     |
| Хранилище файлов (Документы?) | FileStorage   | Полноценный пакет        | На стадии идеи. Пакет для загрузки и хранения разных файлов.                                                                                                                                                           | Not initialized                                  | 0% :o:                     |
| Настройки SEO                 | SEO           | Вспомогательный пакет    | Вспомогательный пакет для добавления SEO настроек к необходимым пакетам (пример: Новости, Страницы). Доступна мультиязычность.                                                                                         | https://github.com/IBEC-BOX/admin-kit-seo        | Готово :white_check_mark:  |
| Архитектурный паттерн Porto   | Porto         | Полноценный пакет        | Для реализации Архитектурного паттерна [Porto](https://github.com/Mahmoudz/Porto)([ru](https://github.com/dnsoftware/porto_ru)) при разработке проекта. В Core пакете используется для автозагрузки Middleware.        | https://github.com/IBEC-BOX/laravel-porto        | 90% :white_check_mark:     |

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
