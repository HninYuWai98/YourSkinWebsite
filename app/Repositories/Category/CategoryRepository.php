<?php

namespace App\Repositories\Category;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;
use App\Foundations\BaseRepository\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function connection(): Model
    {
        return new Category();
    }

    protected function optionsQuery(array $options)
    {
        $query = parent::optionsQuery($options);

        if (!empty($options['category_id'])) {
            $query = $query->where('id', $options['category_id']);
        }

        if (isset($options['category_name'])){
            $query = $query->where('name',$options['category_name']);
        }

        if (isset($options['category_code'])){
            $query = $query->where('code',$options['category_code']);
        }

        return $query;
    }
}
