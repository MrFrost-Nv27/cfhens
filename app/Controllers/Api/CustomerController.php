<?php

namespace App\Controllers\Api;

use App\Controllers\BaseApi;
use App\Models\Detailing\Customer;
use App\Models\PenggunaModel;
use CodeIgniter\Shield\Authentication\Passwords;

class CustomerController extends BaseApi
{
    protected $modelName = Customer::class;
    protected $load = ["user"];

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

    public function beforeCreate(&$data)
    {

        $user = PenggunaModel::create([
            'username' => $this->request->getVar('username'),
            'name' => $data->name,
        ])->setEmailIdentity([
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ])->addGroup('user')->activate();

        $data->user_id = $user->id;
    }

    public function beforeUpdate(&$data)
    {
        if ($this->request->getVar('password')) {
            if ($this->request->getVar('password') != $this->request->getVar('password_confirm')) {
                return false;
            }
            $userProvider = auth()->getProvider();
            $user = $userProvider->find($data->user_id);
            $user->fill(['password' => $this->request->getVar('password')]);
            $userProvider->save($user);
        }
    }

    public function afterDelete(&$data)
    {
        $users = auth()->getProvider();
        $users->delete($data->user_id, true);
    }
}
