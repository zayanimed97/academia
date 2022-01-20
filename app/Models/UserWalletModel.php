<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UserWalletModel extends Model
{
	
    protected $table = 'user_wallet';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_user','discount','id_ente','id_item','created_at'];
	protected $returnType = 'array';

	
}