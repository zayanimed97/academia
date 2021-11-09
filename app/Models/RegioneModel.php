<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class RegioneModel extends Model
{
	
    protected $table = 'regione';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_nazione', 'regione'];
	
	protected $returnType = 'array';
	
	
}