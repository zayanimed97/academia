<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ParticipationOnlineStatusModel extends Model
{
	
    protected $table = 'participation_online_status';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_participation', 'vimeo_id','status','cursor_position','created_at'];
	
	protected $returnType = 'array';
	
	
}