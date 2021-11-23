<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloTestModel extends Model
{
	
    protected $table = 'corsi_modulo_test';
	protected $primaryKey = 'id';
    protected $allowedFields = ['title','type','auto_score','enable','banned','ord','nb_repeat','min_points','id_ente'];
	
	protected $returnType = 'array';
	
}