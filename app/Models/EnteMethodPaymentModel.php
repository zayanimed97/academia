<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class EnteMethodPaymentModel extends Model
{
	
    protected $table = 'ente_method_payment';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_method', 'id_ente','details','enable','banned'];
	
	protected $returnType = 'array';
	
	
}