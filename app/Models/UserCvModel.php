<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UserCvModel extends Model
{
	
    protected $table = 'user_cv';
	protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','cv','titolo','created_at','banned'];
	protected $returnType = 'array';

	
}