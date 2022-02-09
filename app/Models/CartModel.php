<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CartModel extends Model
{
	
    protected $table = 'cart';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_ente', 'id_user','date','total_ht','total_vat','id_professione','status','coupon','update_at','banned','fattureincloud','fatturazione'];
	
	protected $returnType = 'array';
	
	
	
}