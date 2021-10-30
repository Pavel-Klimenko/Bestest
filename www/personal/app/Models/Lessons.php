<?php
namespace App\Models;

use CodeIgniter\Model;

class Lessons extends Model
{
    protected $table = 'lessons_history';
    protected $primaryKey = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['USER_ID', 'LESSON_CODE', 'LESSON_TYPE', 'LESSON_LEVEL', 'LESSON_STATUS'];
}
