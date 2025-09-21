<?php

namespace App\Repositories\Brand;

use App\Models\Brand\Brand;
use Illuminate\Database\Eloquent\Model;
use App\Foundations\BaseRepository\BaseRepository;
use App\Repositories\Brand\BrandRepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{

    public function connection(): Model
    {
        return new Brand();
    }

    protected function optionsQuery(array $options)
    {
        $query = parent::optionsQuery($options);

        return $query;
    }
}
