<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'orfeusz';
    protected $table = 'users';
    protected $primaryKey = 'idusers';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

}
