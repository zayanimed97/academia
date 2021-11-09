<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class EntePackageModel extends Model
{
	
    protected $table = 'ente_package';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_ente', 'package','expired_date'];
	
	protected $returnType = 'array';
	
	
}