<?php
namespace App\Controllers;
use App\Models\lessons;
use CodeIgniter\Model;
use App\Models\Users;
require_once $_SERVER['DOCUMENT_ROOT'].'/personal/app/Helpers/HelperFunctions.php';

class RegistrationController extends BaseController
{
    protected $session;
    protected $model;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = session();
        $this->model = new Users();
    }


    public function renderForm()
    {
        return view('registration/form');
    }


    public function register()
    {
        $inputs = $this->validate([
            'login' => 'required|min_length[4]',
            'email' => 'required|valid_email',
            'pass' => 'required|min_length[3]|alpha_numeric',
            'pass2' => 'required|matches[pass]',
        ]);

        if (!$inputs) {
            return view('registration/errors', [
                'validation' => $this->validator,
            ]);
        }

        $data['login'] = $this->request->getVar('login');
        $data['email'] = $this->request->getVar('email');
        $data['pass'] = $this->request->getVar('pass');
        $data['pass2'] = $this->request->getVar('pass2');

        $userDataByLogin = $this->model->where('LOGIN', $data['login'])->findAll();
        $userDataByEmail = $this->model->where('EMAIL', $data['email'])->findAll();

        $userErrors = [];
        if (!empty($userDataByLogin)) {
            $userErrors[] = 'User with this login is already registered';
        }

        if (!empty($userDataByEmail)) {
            $userErrors[] = 'User with this email is already registered';
        }

        //We check for errors and display it to the user
       if ($userErrors != NULL && count($userErrors) > 0) {
            $data['registered'] = $userErrors;
            return view('registration/success', $data);
        } else {
            $data = [
                'LOGIN' => $data['login'],
                'EMAIL' => $data['email'],
                'PASSWORD' => password_hash($data['pass'], PASSWORD_DEFAULT ),
            ];

            $this->model->insert($data);
            $data['registered'] = 'User successful registered';
            return view('registration/success', $data);
        }
   }

}


