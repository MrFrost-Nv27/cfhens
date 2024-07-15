<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Cfhens\DiseaseModel;

class DiseaseController extends BaseApi
{
    protected $modelName = DiseaseModel::class;

    public function validateCreate(&$request)
    {
        return $this->validate([
            'code' => 'required',
            'name' => 'required',
        ]);
    }
}
