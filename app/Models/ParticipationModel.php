<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ParticipationModel extends Model
{
	
    protected $table = 'participation';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_cart', 'id_ente','id_user','id_modulo','id_date','date','banned','confirm_mail'];
	
	protected $returnType = 'array';
	
	
	
}