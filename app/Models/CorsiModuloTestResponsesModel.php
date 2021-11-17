<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloTestResponsesModel extends Model
{
	
    protected $table = 'corsi_modulo_test_responses';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_q', 'points','response'];
	
	protected $returnType = 'array';
	
	
}