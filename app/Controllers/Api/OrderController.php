<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Detailing\Order;

class OrderController extends BaseApi
{
    protected $modelName = Order::class;
    protected $load = ['service', 'customer', 'pay'];

    public function validateCreate(&$request)
    {
        return $this->validate([
            'service_id' => 'required',
            'total' => 'required',
            'date' => 'required',
        ]);
    }

    public function pending()
    {
        $data = $this->modelName::doesntHave("pay")->get();
        if ($this->load) {
            $data = $data->load($this->load);
        }
        if ($this->append) {
            $data = $data->append($this->append);
        }
        return $this->respond($data);
    }
    public function payed()
    {
        $data = $this->modelName::has("pay")->get();
        $dateStart = $this->request->getVar('start');
        $dateEnd = $this->request->getVar('end');
        if ($dateStart && $dateEnd) {
            $data = $data->where('date', '>=', $dateStart)->where('date', '<=', $dateEnd);
        } elseif ($dateStart && !$dateEnd) {
            $data = $data->where('date', '>=', $dateStart);
        } elseif (!$dateStart && $dateEnd) {
            $data = $data->where('date', '<=', $dateEnd);
        }
        if ($this->load) {
            $data = $data->load($this->load);
        }
        if ($this->append) {
            $data = $data->append($this->append);
        }
        return $this->respond($data);
    }
}
