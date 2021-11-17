<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ObiettiviFormazioneModel extends Model
{
	
    protected $table = 'obiettivi_formazione';
	protected $primaryKey = 'id';
    protected $allowedFields = ['titolo', 'codice','testo','url','foto','banned','id_ente'];
	
	protected $returnType = 'array';
	
	
}