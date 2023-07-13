# Admin-Kit Core Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibecsystems/admin-kit-core.svg?style=flat-square)](https://packagist.org/packages/ibecsystems/admin-kit-core)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/IBEC-BOX/admin-kit-core/run-tests.yml?branch=2.x&label=tests&style=flat-square)](https://github.com/IBEC-BOX/admin-kit-core/actions?query=workflow:run-tests+branch:2.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/IBEC-BOX/admin-kit-core/fix-php-code-style-issues.yml?branch=2.x&label=code%20style&style=flat-square)](https://github.com/IBEC-BOX/admin-kit-core/actions?query=workflow:"Fix+PHP+code+style+issues"+branch:2.x)
[![Total Downloads](https://img.shields.io/packagist/dt/ibecsystems/admin-kit-core.svg?style=flat-square)](https://packagist.org/packages/ibecsystems/admin-kit-core)

Пакет имеет готовые модули для быстрого старта проекта. 
Использует админ панель Filament, и содержит готовые API эндпоинты, что и служит улучшением и ускорением разработки админ панелей.

## Структура пакетов Admin Kit

На текущий момент созданы следующие пакеты для Admin Kit:

| Название                      | Код                                                            | Тип пакета         | Описание                                                                                                                                                                                                               | Готовность                 |
|-------------------------------|----------------------------------------------------------------|--------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------|
| Ядро                          | [Core](https://github.com/IBEC-BOX/admin-kit-core)             | Базовый            | Пакет содержит идеологию, настройки по умолчанию, кастомные поля и модуль Users                                                                                                                                        | Готово :white_check_mark:  |
| Пользователи                  | [Users](https://github.com/IBEC-BOX/admin-kit-core)            | -                  | Находится в составе пакета Core, незаменимый модуль Core пакета                                                                                                                                                        | Готово :white_check_mark:  |
| Роли                          | [Roles](https://github.com/bezhanSalleh/filament-shield)       | Внешний            | Используется пакет [Filament Shield](https://github.com/bezhanSalleh/filament-shield), настройки по умолчанию интегрированы с в пакет Core                                                                             | Готово :white_check_mark:  |
| Меню                          | [Navigation](https://github.com/IBEC-BOX/admin-kit-navigation) | Полноценный (Форк) | Пакет для создания элементов меню. Сделан форк внешнего пакета [Filament Navigation](https://github.com/ryangjchandler/filament-navigation), который кастомизирован под идеологию Admin Kit. Доступна мультиязычность. | Готово :white_check_mark:  |
| Новости                       | [Articles](https://github.com/IBEC-BOX/admin-kit-articles)     | Полноценный        | Пакет для создания новостей. Доступна мультиязычность.                                                                                                                                                                 | Готово :white_check_mark:  |
| Страницы                      | [Pages](https://github.com/IBEC-BOX/admin-kit-pages)           | Полноценный        | В разработке. Пакет для создания WYSIWYG страниц. Доступна мультиязычность.                                                                                                                                            | 50% :large_orange_diamond: |
| Документы                     | [Documents](https://github.com/IBEC-BOX/admin-kit-documents)   | Полноценный        | В разработке. Пакет для загрузки документов(файлов). Доступна мультиязычность.                                                                                                                                         | 50% :large_orange_diamond: |
| Локализация                   | Localizations                                                  | Полноценный        | В разработке. Пакет для создания переводов для фронт разработчиков. Доступна мультиязычность.                                                                                                                          | 50% :large_orange_diamond: |
| Баннеры                       | [Banners](https://github.com/IBEC-BOX/admin-kit-banners)       | Полноценный        | На стадии идеи. Пакет для создания Баннеров. Доступна мультиязычность.                                                                                                                                                 | 10% :o:                    |
| Частые вопросы                | [FAQs](https://github.com/IBEC-BOX/admin-kit-faqs)             | Полноценный        | На стадии идеи. Пакет для создания Частых Вопросов. Доступна мультиязычность.                                                                                                                                          | 10% :o:                    |
| Опросы                        | [Polls](https://github.com/IBEC-BOX/admin-kit-polls)           | Полноценный        | На стадии идеи. Пакет для создания Опросов.                                                                                                                                                                            | 10% :o:                    |
| Вакансии                      | [Vacancies](https://github.com/IBEC-BOX/admin-kit-vacancies)   | Полноценный        | На стадии идеи. Пакет для создания Вакансий. Дополнительно содержит города, должности, форму для заявок.                                                                                                               | 10% :o:                    |
| Галерея                       | Gallery                                                        | Полноценный        | На стадии идеи. Пакет для создания Фото/Видео галереи.                                                                                                                                                                 | 0% :o:                     |
| Хранилище файлов (Документы?) | FileStorage                                                    | Полноценный        | На стадии идеи. Пакет для загрузки и хранения разных файлов.                                                                                                                                                           | 0% :o:                     |
| Настройки SEO                 | [SEO](https://github.com/IBEC-BOX/admin-kit-seo)               | Вспомогательный    | Вспомогательный пакет для добавления SEO настроек к необходимым пакетам (пример: Новости, Страницы). Доступна мультиязычность.                                                                                         | Готово :white_check_mark:  |
| Архитектурный паттерн Porto   | [Porto](https://github.com/IBEC-BOX/laravel-porto)             | Полноценный        | Для реализации Архитектурного паттерна [Porto](https://github.com/Mahmoudz/Porto)([ru](https://github.com/dnsoftware/porto_ru)) при разработке проекта. В Core пакете используется для автозагрузки Middleware.        | 90% :white_check_mark:     |

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
