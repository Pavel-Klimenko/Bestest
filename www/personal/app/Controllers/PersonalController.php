<?php
namespace App\Controllers;

use App\Models\Lessons;
use CodeIgniter\Model;
use Config\App;

class PersonalController extends BaseController
{
    protected $session;
    protected $model;

    public function __construct()
    {
        $this->session = session();
        $this->model = new Lessons();
    }

    /** Getting statistics on user lessons by his ID
     *
     */
    public function showUserLessons()
    {
        if ($this->session->get('is_auth')) {
            $userID = $this->session->get('user_id');
            $data['user_lessons'] = $this->model->where('USER_ID', $userID)->findAll();
            echo view('personalArea/index', $data);
        } else {
            return redirect()->to('/auth/');
        }
    }

    public function saveLesson()
    {
        $response['type'] = $this->request->getVar('type');
        $response['level'] = $this->request->getVar('level');
        $response['code'] = $this->request->getVar('code');
        $response['status'] = $this->request->getVar('status');

        if ($this->session->get('is_auth')) {
            $data = [
                'USER_ID' => $this->session->get('user_id'),
                'LESSON_CODE' => $response['code'],
                'LESSON_TYPE' => $response['type'],
                'LESSON_LEVEL' => $response['level'],
                'LESSON_STATUS' => $response['status'],
            ];

            $this->model->insert($data);
            echo json_encode($data);
        }
    }

}
