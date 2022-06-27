<?php

namespace AdminKit\Core\Models;

use AdminKit\Core\Presenters\UserPresenter;

class User extends \Orchid\Platform\Models\User
{
    /**
     * @return UserPresenter
     */
    public function presenter()
    {
        return new UserPresenter($this);
    }
}
