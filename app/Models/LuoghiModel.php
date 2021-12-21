<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class LuoghiModel extends Model
{
	
    protected $table = 'luoghi';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_ente','nome', 'id_def','banned','enable'];
	 
	protected $returnType = 'array';
	
	public function get_luoghi_have_cours($corsi_type=null){
		$db = \Config\Database::connect();
		$req="select * from ".$this->table." where banned='no' and enable='yes' and id IN(select id_luoghi from corsi where banned='no' and status='si'";
		if(!is_null($corsi_type)) $req.=" and tipologia_corsi LIKE '".$db->escapeLikeString($corsi_type)."'";
		 $req.=")";
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	} 
	
}