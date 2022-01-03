<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ParticipationOnlineEventModel extends Model
{
	
    protected $table = 'participation_online_event';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_participation', 'vimeo_id','event','duration','cursor_position','created_at'];
	
	protected $returnType = 'array';
	
	
}