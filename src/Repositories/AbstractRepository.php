<?php

declare(strict_types=1);

namespace AdminKit\Core\Repositories;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct()
    {
        $this->makeModel();
        $this->boot();
    }

    public function boot()
    {
        //
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    abstract public function model();

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function makeModel(): Model
    {
        $model = app()->make($this->model());

        if (! $model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    public function all($columns = ['*']): Collection
    {
        return $this->model->all($columns);
    }
}
