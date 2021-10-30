<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Users;
use CodeIgniter\Model;
use CodeIgniter\Helpers\HelperFunctions;
use CodeIgniter\HTTP\IncomingRequest;
require_once $_SERVER['DOCUMENT_ROOT'].'/personal/app/Helpers/HelperFunctions.php';

class AuthController extends Controller
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
        return view('auth/form');
    }

    public function authorize()
    {

        $inputs = $this->validate([
            'login' => 'required',
            'pass' => 'required',
        ]);

        if (!$inputs) {
            return view('registration/errors', [
                'validation' => $this->validator,
            ]);
        }

        $data['login'] = $this->request->getVar('login');
        $data['pass'] = $this->request->getVar('pass');

        $errors = [];

        $userDataFromDB = $this->model->where('LOGIN', $data['login'])->findAll();

        if (empty($userDataFromDB)) {
            $errors[] = 'Пользователь с данным логином не найден';
        } elseif (!password_verify($data['pass'], $userDataFromDB[0]['PASSWORD'])) {
            $errors[] = 'Неверный пароль';
        }

        //We check for errors and display it to the user
        if ($errors != NULL && count($errors) > 0) {
            $data['auth_status'] = $errors;
        } else {
            $data['auth_status'] = 'You are successfully logged in as '. $data['login'];
            $sessionData = [
                'is_auth'  => true,
                'user_id' => $userDataFromDB[0]['ID'],
                'user_login' => $userDataFromDB[0]['LOGIN'],
                'user_pass' => $userDataFromDB[0]['PASSWORD'],
            ];

            $this->session->remove(array_keys($sessionData));

            //installation of user data into the session
            $this->session->set($sessionData);

        }

        return view('auth/handler', $data);
    }


    public function logout() {
        $sessionData = ['is_auth','user_id', 'user_login', 'user_pass'];
        $this->session->remove($sessionData);
        header("Location:".base_url());
    }

}


