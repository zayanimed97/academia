<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CategorieModel extends Model
{
	
    protected $table = 'categorie';
	protected $primaryKey = 'id';
    protected $allowedFields = ['titolo', 'status','testo','url','foto','banned','id_ente'];
	
	protected $returnType = 'array';
	
	
}