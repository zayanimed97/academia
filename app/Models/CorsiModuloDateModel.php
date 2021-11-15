<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloDateModel extends Model
{
	
    protected $table = 'corsi_modulo_date';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_modulo', 'date','start_time','end_time','banned','incontro','zoom_url'];
	
	protected $returnType = 'array';
	
	
}