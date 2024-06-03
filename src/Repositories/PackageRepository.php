<?php

declare(strict_types=1);

namespace AdminKit\Core\Repositories;

class PackageRepository
{
    public function getList()
    {
        return [
            [
                'name' => 'ibecsystems/admin-kit-articles',
                'label' => 'Admin-Kit Новости',
            ],
            [
                'name' => 'ibecsystems/admin-kit-banners',
                'label' => 'Admin-Kit Баннеры',
            ],
            [
                'name' => 'ibecsystems/admin-kit-brand',
                'label' => 'Admin-Kit Бренд',
            ],
            [
                'name' => 'ibecsystems/admin-kit-companies',
                'label' => 'Admin-Kit Компании',
            ],
            [
                'name' => 'ibecsystems/admin-kit-contacts',
                'label' => 'Admin-Kit Контакты',
            ],
            [
                'name' => 'ibecsystems/admin-kit-documents',
                'label' => 'Admin-Kit Документы',
            ],
            [
                'name' => 'ibecsystems/admin-kit-entry-screens',
                'label' => 'Admin-Kit Начальные экраны',
            ],
            [
                'name' => 'ibecsystems/admin-kit-faqs',
                'label' => 'Admin-Kit FAQs',
            ],
            [
                'name' => 'ibecsystems/admin-kit-feedbacks',
                'label' => 'Admin-Kit Обратная связь',
            ],
            [
                'name' => 'ibecsystems/admin-kit-infographics',
                'label' => 'Admin-Kit Инфографика',
            ],
            [
                'name' => 'ibecsystems/admin-kit-localizations',
                'label' => 'Admin-Kit Локализации (Переводы)',
            ],
            [
                'name' => 'ibecsystems/admin-kit-navigation',
                'label' => 'Admin-Kit Меню',
            ],
            [
                'name' => 'ibecsystems/admin-kit-pages',
                'label' => 'Admin-Kit Страницы',
            ],
            [
                'name' => 'ibecsystems/admin-kit-polls',
                'label' => 'Admin-Kit Опросы',
            ],
            [
                'name' => 'ibecsystems/admin-kit-products',
                'label' => 'Admin-Kit Продукция',
            ],
            [
                'name' => 'ibecsystems/admin-kit-projects',
                'label' => 'Admin-Kit Проекты',
            ],
            [
                'name' => 'ibecsystems/admin-kit-reviews',
                'label' => 'Admin-Kit Отзывы',
            ],
            [
                'name' => 'ibecsystems/admin-kit-scramble',
                'label' => 'Admin-Kit API Документация',
            ],
            [
                'name' => 'ibecsystems/admin-kit-seo',
                'label' => 'Admin-Kit SEO',
            ],
            [
                'name' => 'ibecsystems/admin-kit-settings',
                'label' => 'Admin-Kit Настройки',
            ],
            [
                'name' => 'ibecsystems/admin-kit-social-medias',
                'label' => 'Admin-Kit Социальные сети',
            ],
            [
                'name' => 'ibecsystems/admin-kit-social-projects',
                'label' => 'Admin-Kit Проекты',
            ],
            [
                'name' => 'ibecsystems/admin-kit-vacancy',
                'label' => 'Admin-Kit Вакансии',
            ],
            [
                'name' => 'ibecsystems/laravel-porto',
                'label' => 'Laravel Porto (Архитектура)',
            ],
        ];
    }
}
