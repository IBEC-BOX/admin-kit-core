<?php

declare(strict_types=1);

namespace AdminKit\Core\Abstracts\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Паттерн Репозиторий.
 * Состояние не хранится.
 * Для получения данных модели.
 * Не для изменения/удаления модели.
 */
abstract class AbstractRepository
{
    private Model $model;

    abstract public function getModelClass(): string;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * Получение модели при помощи клонирования
     */
    public function model(): Model
    {
        return clone $this->model;
    }
}
