<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class SottoargomentiModel extends Model
{
	
    protected $table = 'sottoargomenti';
	protected $primaryKey = 'id';
    protected $allowedFields = ['titolo', 'id_argomenti','testo','url','banned'];
	
	protected $returnType = 'array';
	
	
}