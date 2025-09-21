<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Foundations\BaseRepository\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function connection(): Model
    {
        return new User();
    }

    protected function optionsQuery(array $options)
    {
        $query = parent::optionsQuery($options);

        return $query;
    }
}
