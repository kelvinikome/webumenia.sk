<?php

namespace App\Repositories;

use App\Item;

class ItemRepository extends AbstractRepository
{
    protected $index = 'webumenia_sk';

    protected $modelClass = Item::class;

    public function getRandom($size, array $filter = [])
    {
        if (!array_key_exists('has_image', $filter)) {
            $filter['has_image'] = true;
        }

        if (!array_key_exists('has_iip', $filter)) {
            $filter['has_iip'] = true;
        }

        return parent::getRandom($size, $filter);
    }
}