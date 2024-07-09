<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Entities\User;
use App\Models\PenggunaModel;
use CodeIgniter\Shield\Authentication\Passwords;

class UserController extends BaseApi
{
    protected $modelName = PenggunaModel::class;

    public function index()
    {
        $userProvidedr = auth()->getProvider();
        $users = collect($userProvidedr->findAll());
        $data = $users->filter(function (User $user) {
            return $user->inGroup('admin');
        });
        return $this->respond($data);
    }

    public function validateCreate(&$request)
    {
        return $this->validate([
            'name' => 'required',
            'username' => 'required|max_length[30]|min_length[3]|regex_match[/\A[a-zA-Z0-9\.]+\z/]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|' . Passwords::getMaxLengthRule(),
            'password_confirm' => 'required|matches[password]',
        ]);
    }

    public function create()
    {
        $data = new $this->modelName;

        $request = (array) $this->request->getVar();
        if ($this->validateCreate($request) == false) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = PenggunaModel::create([
            'username' => $this->request->getVar('username'),
            'name' => $this->request->getVar('name'),
        ])->setEmailIdentity([
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ])->addGroup('admin')->activate();

        return $this->respond([
            'messages' => [
                'success' => 'data baru berhasil di tambahkan',
            ],
            'data' => $data,
        ]);
    }

    public function update($id = null)
    {
        $request = (array) $this->request->getVar();
        if ($this->validateUpdate($request) == false) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        if ($data = $this->modelName::find($id)) {
            $userProvider = auth()->getProvider();
            $user = $userProvider->find($id);
            if (isset($request['password'])) {
                if ($request['password'] != $request['password_confirm']) {
                    return false;
                }
                $user->fill(['password' => $request['password']]);
                unset($request['password']);
                unset($request['password_confirm']);
            }
            $user->fill($request);
            $userProvider->save($user);

            return $this->respond([
                'messages' => [
                    'success' => 'data berhasil di simpan',
                ],
                'data' => $data,
            ]);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }

    public function delete($id = null)
    {
        $users = auth()->getProvider();
        try {
            $users->delete($id, true);
            return $this->respondDeleted(
                [
                    'messages' => [
                        'success' => 'data berhasil di hapus',
                    ],
                ]
            );
        } catch (\Throwable $th) {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}
