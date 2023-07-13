# Какие возможности реализованы в пакете?

## Fields

### AdminKitCropper
Поле Cropper, скопированный у пакета [`nuhel/filament-cropper`](https://github.com/Nuhel/filament-cropper). 
Отличие лишь в том, что `AdminKitCropper` наследуется от класса `SpatieMediaLibraryFileUpload`, что позволяет конвертировать и создавать thumbnail файлы изображений.

## Layouts

### TranslatableTabs
Шаблон выводит стандартный [Filament Tabs](https://filamentphp.com/docs/2.x/forms/layout#tabs).
Пример использования:
```php
    // Filament/Resources/Resource.php
    public static function form(Form $form): Form
    {
        return $form->schema([

            // other fields ...

            TranslatableTabs::make(fn ($locale) => Tabs\Tab::make($locale)
                ->schema([
                    Forms\Components\TextInput::make("title.$locale")
                        ->label('title'))
                        ->required($locale === app()->getLocale()),
                ])),

            // other fields ...

        ]);
    }
```

## Middlewares

### SetLocaleFromAcceptLanguageHeader
- Подключается автоматически.
- Устанавливает язык ответа приложения, используя заголовок `Accept-Language` из запроса.

### ForceJsonApiResponse
- Подключается автоматически.
- Преобразует все ответы по роутам `api/*` в JSON, путем добавления заголовка `Accept: application/json` во входящем запросе.

### CheckAdminIpMiddleware
- Подключается автоматически.
- При установке значения `ADMIN_WHITE_LIST_ENABLE=true` в `.env` файле, доступ в админ панель блокируется всем пользователям, за исключением IP адресов из белого листа, указанных в файле конфига `config/admin-kit.php`
