<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CouponModel extends Model
{
	
    protected $table = 'coupon';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_ente', 'code','coupon_type','start_date','end_date','id_corsi','id_docenti','id_argomenti','nb_use','nb_use','used','type','amount','enable','banned'];
	
	protected $returnType = 'array';
	
	
	
}