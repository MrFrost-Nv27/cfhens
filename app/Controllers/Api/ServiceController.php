<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Detailing\Service;

class ServiceController extends BaseApi
{
    protected $modelName = Service::class;

    public function validateCreate(&$request)
    {
        return $this->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
    }

    public function afterCreate(&$data)
    {
        $this->fileUpload($data);
    }
    public function afterUpdate(&$data)
    {
        $this->fileUpload($data);
    }

    protected function fileUpload(&$data)
    {
        $file = $this->request->getFile("image");
        if ($file?->isFile()) {
            if ($data->image) {
                echo $data->image;
            }
            $ext = $file->getExtension();
            if ($file->move(FCPATH . "img/services", "$data->id.$ext", true)) {
                $data->update(['image' => "$data->id.$ext"]);
            }
        }
    }
}
