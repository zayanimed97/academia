<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CartItemsModel extends Model
{
	
    protected $table = 'cart_items';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_cart', 'item_type','item_id','price_ht','vat','details','banned'];
	
	protected $returnType = 'array';
	
	
	
}