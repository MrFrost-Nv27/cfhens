<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Detailing\Repair;

class RepairController extends BaseApi
{
    protected $modelName = Repair::class;
    protected $load = ['customer'];

    public function validateCreate(&$request)
    {
        return $this->validate([
            'name' => 'required',
            'date' => 'required',
        ]);
    }

    public function beforeUpdate(&$data)
    {
        if ($this->request->getVar('pay')) {
            $data->paydate = date('Y-m-d');
        }
    }
}
