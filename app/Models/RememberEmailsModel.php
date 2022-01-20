<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class RememberEmailsModel extends Model
{
	
    protected $table = 'remember_emails';
	protected $primaryKey = 'id';
    protected $allowedFields = ['nb_days', 'tipologia_corsi','subject','text','enable','banned','id_ente'];
	
	protected $returnType = 'array';
	
	
}