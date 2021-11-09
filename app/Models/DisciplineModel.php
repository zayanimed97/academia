<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class DisciplineModel extends Model
{
	
    protected $table = 'discipline';
	protected $primaryKey = 'iddisciplina';
    protected $allowedFields = ['codice_disciplina', 'disciplina','status','idprofessione'];
	
	protected $returnType = 'array';
	
	
}