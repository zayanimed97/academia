<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloVimeoModel extends Model
{
	
    protected $table = 'corsi_modulo_vimeo';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_modulo', 'vimeo','ord','banned','enable'];
	
	protected $returnType = 'array';
	
	
}