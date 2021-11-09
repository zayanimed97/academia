<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UsersLogModel extends Model
{
	
    protected $table = 'users_log';
	protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','date','action','cookies','details'];
	protected $returnType = 'array';

	
}