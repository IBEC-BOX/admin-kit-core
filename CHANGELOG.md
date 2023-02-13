# Changelog

All notable changes to `AdminKit/Core` will be documented in this file.

## v1.2.6 - 2023-02-13

- remove 'orchid:admin' command from 'admin-kit:install' command

## v1.2.5 - 2023-02-13

- add set env APP_URL for install command

## v1.2.4 - 2023-01-27

- fix registerMenuFromPackages() method

## v1.2.3 - 2023-01-27

- add registerMenuFromPackages() method in PlatformProvider
- add is_dev() helper

## v1.2.2 - 2023-01-23

- add CyillicChars trait

## v1.2.1 - 2023-01-17

- add all commands in one with confirm question
- - php artisan storage:link
- - php artisan migrate
- - php artisan orchid:admin
- - function setEnv()
- 

## v1.2.0 - 2023-01-17

- change default user model to AdminUser
- change default table names
- add new provider and guard "admin-kit" for new AdminUser
- update "admin-kit:install" command

## v1.1.0 - 2023-01-15

- customize header and footer views
- add base AdminKitModal

## v1.0.5 - 2023-01-10

- change package name configure to 'admin-kit'

## v1.0.4 - 2023-01-07

- update readme

## v1.0.3 - 2023-01-07

- add changelog file

## v1.0.2 - 2023-01-07

- use package-skeleton-laravel for this repo
