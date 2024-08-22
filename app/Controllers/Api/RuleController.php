<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Cfhens\RuleModel;
use App\Models\Cfhens\SymptomModel;
use Ramsey\Uuid\Uuid;

class RuleController extends BaseApi
{
    protected $modelName = RuleModel::class;
    protected $load = ["symptom", "disease"];

    public function validateCreate(&$request)
    {
        return $this->validate([
            'code' => 'required',
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

    public function creates()
    {
        $items = $this->request->getJSON();
        $data = [];
        foreach ($items as $item) {
            $data[] = [
                'id' => Uuid::uuid4(),
                'code' => $item->code,
                'symptom_id' => $item->symptom_id,
                'disease_id' => $item->disease_id
            ];
        }

        foreach ($data as $key => $value) {
            $this->validateCreate($value);
        }

        RuleModel::insert($data);
        return $this->respond([
            'messages' => [
                'success' => 'Data berhasil disimpan',
            ],
        ]);
    }

    public function updates()
    {
        $items = $this->request->getJSON();
        RuleModel::where('code', $items[0]->code)->delete();
        $data = [];
        foreach ($items as $item) {
            $data[] = [
                'id' => Uuid::uuid4(),
                'code' => $item->code,
                'symptom_id' => $item->symptom_id,
                'disease_id' => $item->disease_id
            ];
        }

        foreach ($data as $key => $value) {
            $this->validateCreate($value);
        }

        RuleModel::insert($data);
        return $this->respond([
            'messages' => [
                'success' => 'Data berhasil disimpan',
            ],
        ]);
    }
}
