<?php

use AdminKit\Core\Containers\ArticleSection;
//use AdminKit\Core\Containers\DirectorySection;
//use AdminKit\Core\Containers\MenuSection;
use AdminKit\Core\Containers\UserSection;

// config for AdminKit/Core
return [
    'containers' => [
        UserSection\User\Providers\MainServiceProvider::class,
        ArticleSection\Article\Providers\MainServiceProvider::class,
//        DirectorySection\Directory\Providers\MainServiceProvider::class,
//        MenuSection\Menu\Providers\MainServiceProvider::class,
    ],
];
