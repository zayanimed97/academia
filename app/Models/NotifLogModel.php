<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class NotifLogModel extends Model
{
	
    protected $table = 'notif_log';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_participant','type', 'user_to','subject','message','date'];
	
	protected $returnType = 'array';
	
	
}