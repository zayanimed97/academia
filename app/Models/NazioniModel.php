<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class NazioniModel extends Model
{
	
    protected $table = 'nazioni';
	protected $primaryKey = 'id';
    protected $allowedFields = ['nazione', 'tid','naz_eng','zona','status'];
	
	protected $returnType = 'array';
	
	
}