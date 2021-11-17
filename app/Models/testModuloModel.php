<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class TestModuloModel extends Model
{
	
    protected $table = 'corsi_modulo_test';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_test','id_corsi','id_modulo','banned'];
	
	protected $returnType = 'array';
	
}