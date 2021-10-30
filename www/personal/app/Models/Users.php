<?php
namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'ID';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['LOGIN', 'EMAIL', 'PASSWORD'];
}
