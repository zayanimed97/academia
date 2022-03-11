<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class RememberCartModel extends Model
{
	
    protected $table = 'remember_cart';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_ente', 'id_user','cart','shares','discounts'];
	
	protected $returnType = 'array';
	protected $dateFormat = 'datetime';
    protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
	
}