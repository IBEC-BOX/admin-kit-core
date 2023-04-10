создать папку
```bash
mkdir -p ~/composer-packages/ibecsystems
```

перейти в папку
```bash
cd ~/composer-packages/ibecsystems
```

Склонировать
```bash
git clone https://github.com/ibec-box/admin-kit-core
```

создать скрипт `~/composer-packages/composer.dev.sh` со следующим содержимым:
```bash
echo '#!/usr/bin/env bash

PACKAGES_PATH="~/composer-packages"
REPOSITORIES="{
    \"type\": \"path\",
    \"url\": \"$PACKAGES_PATH/*/*\",
    \"options\": {
        \"symlink\": true
    }
}"

cd `pwd`
jq ".repositories[0] = $REPOSITORIES" composer.json > composer.dev.json
COMPOSER=composer.dev.json composer "$@"' > ~/composer-packages/test.sh
```

даем права запуска на файл `~/composer.dev.sh`
```bash
chmod +x ~/composer.dev.sh
```

добавить алиас. В конец файла `~/.zshrc` или `~/.bashrc`, в зависимости от используемого терминала
```
alias composer-dev="~/composer.dev.sh"
```

применить 
```
source ~/.zhsrc
```


Склонировать и настроить проект https://gitlab.ibecsystems.kz/admin-kit/admin-kit
```bash
git clone git@gitlab.ibecsystems.kz/admin-kit/admin-kit.git
cd ./admin-kit
cp .env .env.example
php artisan key:generate
```

```bash
composer-dev install
```

настраиваем базу данных, и проводим миграции
```bash
php artisan migrate
```

```bash
php artisan orchid:admin
```

запускаем проект
```bash
php artisan serve --port 8005
```

Открываем пакет и начинаем править там код, который будет отображаться в режиме реального реального времени
