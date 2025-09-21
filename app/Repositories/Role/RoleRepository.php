<?php

namespace App\Repositories\Role;


use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use App\Foundations\BaseRepository\BaseRepository;


class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

    public function connection(): Model
    {
        return new Role();
    }

    protected function optionsQuery(array $options)
    {
        $query = parent::optionsQuery($options);

        return $query;
    }
}