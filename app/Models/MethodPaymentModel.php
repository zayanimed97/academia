<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class MethodPaymentModel extends Model
{
	
    protected $table = 'method_payment';
	protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'details','icon','enable','banned'];
	
	protected $returnType = 'array';
	
	
}