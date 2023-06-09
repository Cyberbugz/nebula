<?php

namespace App\Modules\User\Domain\Repositories;

use Dust\Base\Repository;
use App\Modules\User\Domain\Entities\User;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
