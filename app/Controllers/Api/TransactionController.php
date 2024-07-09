<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Detailing\Order;
use App\Models\Detailing\Transaction;

class TransactionController extends BaseApi
{
    protected $modelName = Transaction::class;
    protected $load = ['order'];

    public function validateCreate(&$request)
    {
        return $this->validate([
            'order_id' => 'required',
            'pay' => 'required',
        ]);
    }

    public function afterCreate(&$data)
    {
        $order = Order::find($data->order_id);
        $data->update([
            'status' => 1,
        ]);
        $order->update([
            'status' => 1,
        ]);
    }
}
