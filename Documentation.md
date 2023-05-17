# Какие возможности реализованы в пакете?

## Containers

### Articles

- Подключается из файла конфигурации `admin-kit`.
- Содержит CRUD в админ панели Filament.
- Содержит API эндпоинты для получения списка и детальной информации по новостям.

## Middlewares

### SetLocaleFromAcceptLanguageHeader middleware

- Подключается автоматически.
- Устанавливает язык ответа приложения, используя заголовок `Accept-Language` из запроса.

### ForceJsonApiResponse middleware

- Подключается автоматически.
- Преобразует все ответы по роутам `api/*` в JSON, путем добавления заголовка `Accept: application/json` во входящем запросе.
