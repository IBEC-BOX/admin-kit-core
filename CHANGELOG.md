# Changelog

All notable changes to `ibecsystems/admin-kit-core` will be documented in this file.

## v2.2.4 - 2023-07-17

- fix: Returns Cyrillic characters in Response

## v2.2.3 - 2023-07-14

- add admin white list IP in config

## v2.2.2 - 2023-07-14

- fix FILAMENT_AUTH_GUARD question

## v2.2.1 - 2023-07-14

- fix: correct admin-kit:install command

## v2.2.0 - 2023-07-11

- fix: correct alias for AdminKit facade
- feat: add locales() function in AdminKit facade
- feat: add timezone() function in AdminKit facade
- feat: add TranslatableTabs filament layout

## v2.1.11 - 2023-07-05

- add AdminKitCropper field
- add ip address permissions
- remove kk from filament languages
- change sort admin-kit.locales, ru/kk/en

## v2.1.10 - 2023-07-01

- add filament/spatie-laravel-media-library-plugin

## v2.1.9 - 2023-07-01

- configure timezone for Filament admin

## v2.1.8 - 2023-07-01

- configure timezone for Filament admin

## v2.1.7 - 2023-07-01

- add filament language switcher

## v2.1.6 - 2023-06-30

- call shield:generate command from Install command

## v2.1.5 - 2023-06-30

- add HasRoles trait to AdminKitUser

## v2.1.4 - 2023-06-30

- add spatie/permission migration to admin-kit:install command

## v2.1.3 - 2023-06-30

- add User to config
- add custom filament-shield.php config to stubs

## v2.1.2 - 2023-06-30

- fix v2.1.1

## v2.1.1 - 2023-06-30

- add Users page
- add Roles page
- add commands

## v2.1.0 - 2023-06-28

- change admin_users to admin_kit_users

## v2.0.5 - 2023-06-26

- remove porto architecture

## v2.0.4 - 2023-05-17

- add forceJsonApiResponse middleware
- add SetLocaleFromAcceptLanguageHeader middleware
- remove unused code
- add Documentation.md file
- update for laravel v10

## v2.0.3 - 2023-05-14

rename auth guard to admin-kit-web

## v2.0.2 - 2023-05-14

- upgrade install command with Filament
- add publish Containers migrations
- enable UserContainer
- register Containers from config file
- add guard 'admin-kit'

## v2.0.1 - 2023-05-12

fix deploy branch name 2.x

## v2.0.0 - 2023-05-12

- removed Orchid
- added Filament
- updated Porto to v2
- removed Astrotomic translatable
- added Spatie translatable
- updated Article container
- removed all orchid files(static, code)

## v1.3.2 - 2023-04-27

- translation 'Read' to russian
- use Ship folder
- create Skeleton for copying

## v1.3.1 - 2023-04-27

- [Articles] use jsonPaginate
- [Articles] optimize get list query, without content
- [Articles] use Actions for container

## v1.3.0 - 2023-04-27

add Menu to admin

## v1.2.10 - 2023-04-04

- move repository to IBEC-BOX organization
- rename package to ibecsystems/admin-kit-core

## v1.2.9 - 2023-03-30

- add Directory admin
- add Directory API

## v1.2.8 - 2023-03-28

- use spatie/laravel-query-builder
- use spatie/laravel-data
- add articles API

## v1.2.7 - 2023-03-20

- use admin-kit/porto package
- use Containers from porto

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

- add command 'php artisan storage:link' in install command
- add command 'php artisan migrate' in install command
- add command 'php artisan orchid:admin' in install command
- add command 'function setEnv()' in install command

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
