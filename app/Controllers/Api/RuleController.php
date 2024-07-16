<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Cfhens\RuleModel;
use App\Models\Cfhens\SymptomModel;

class RuleController extends BaseApi
{
    protected $modelName = RuleModel::class;
    protected $load = ["symptom"];
    protected $append = ["effect"];

    public function validateCreate(&$request)
    {
        return $this->validate([
            'code' => 'required',
            'type' => 'required',
        ]);
    }

    public function index()
    {
        $data = $this->modelName::all();
        if ($this->load) {
            $data = $data->load($this->load);
        }
        if ($this->append) {
            $data = $data->append($this->append);
        }
        if ($this->request->getVar("group") == "yes") {
            return $this->respond($data->groupBy('code')->toArray());
        }
        $group = [];
        foreach ($data->groupBy('code') as $key => $g) {
            $group[] = $g->toArray();
        }
        return $this->respond($group);
    }

    public function delete($id = null)
    {
        if ($data = $this->modelName::where("code", $id)) {
            $data->delete();

            return $this->respondDeleted(
                [
                    'messages' => [
                        'success' => 'data berhasil di hapus',
                    ],
                    'data' => $data,
                ]
            );
        }
        return $this->failNotFound('Data tidak ditemukan');
    }
}
