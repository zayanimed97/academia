<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CartPaymentModel extends Model
{
	
    protected $table = 'cart_payment';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_cart', 'id_method','amount','date','status','details','banned'];
	
	protected $returnType = 'array';
	
	
	
}