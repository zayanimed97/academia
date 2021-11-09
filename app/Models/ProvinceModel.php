<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ProvinceModel extends Model
{
	
    protected $table = 'province';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_nazione', 'cod_reg','prov','provincia'];
	
	protected $returnType = 'array';
	
	
}