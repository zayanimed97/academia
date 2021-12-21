<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class AlberghiModel extends Model
{
	
    protected $table = 'alberghi';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_ente','nome', 'pubblica','testo','indirizzo','foto','banned','cap','citta','provincia','telefono','gmap','sito','email','idluogo'];
	
	protected $returnType = 'array';
	
	
}