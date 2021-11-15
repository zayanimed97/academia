<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiGalleriaModel extends Model
{
	
    protected $table = 'corsi_galleria';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_corsi', 'foto','banned'];
	 
	protected $returnType = 'array';
	
	
}