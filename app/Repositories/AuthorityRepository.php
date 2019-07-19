<?php

namespace App\Repositories;

use App\Authority;

class AuthorityRepository extends AbstractRepository
{
    protected $index = 'webumenia_sk';

    protected $modelClass = Authority::class;
}