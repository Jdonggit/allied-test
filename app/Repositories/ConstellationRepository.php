<?php

namespace App\Repositories;

use Yish\Generators\Foundation\Repository\Repository;
use App\Models\Constellation;

class ConstellationRepository extends Repository
{
    protected $model;

    public function __construct(Constellation $constellation)
    {
        $this->model = $constellation;
    }
    

    public function insert($data)
    {
        $this->model->insert($data);
    }
}
