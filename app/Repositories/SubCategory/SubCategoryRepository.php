<?php

namespace App\Repositories\SubCategory;

use App\Models\SubCategory\SubCategory;
use Illuminate\Database\Eloquent\Model;
use App\Foundations\BaseRepository\BaseRepository;

class SubCategoryRepository extends BaseRepository implements SubCategoryRepositoryInterface
{

    public function connection(): Model
    {
        return new SubCategory();
    }

    protected function optionsQuery(array $options)
    {
        $query = parent::optionsQuery($options);
        
        return $query;
    }
}
