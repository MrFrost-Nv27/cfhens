<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Cfhens\SymptomModel;

class SymptomController extends BaseApi
{
    protected $modelName = SymptomModel::class;

    public function validateCreate(&$request)
    {
        return $this->validate([
            'code' => 'required',
            'name' => 'required',
        ]);
    }
}
