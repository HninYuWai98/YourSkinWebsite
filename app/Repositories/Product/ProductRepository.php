<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use App\Foundations\BaseRepository\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function connection(): Model
    {
        return new Product();
    }

    protected function optionsQuery(array $options)
    {
        $query = parent::optionsQuery($options);

        if (!empty($options['sub_category_id'])) {
            $query = $query->where('id', $options['sub_category_id']);
        }

        return $query;
    }
}
