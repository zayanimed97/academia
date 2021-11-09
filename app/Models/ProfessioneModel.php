<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ProfessioneModel extends Model
{
	
    protected $table = 'professione';
	protected $primaryKey = 'idprof';
    protected $allowedFields = ['codice', 'professione','status','id_ente'];
	
	protected $returnType = 'array';
	
	public function get($id_ente=null){
		$db = \Config\Database::connect();
		$req="SELECT * FROM ".$this->table." where status='enable' and idprof IN(select professione from user_profile) ";
		if(!is_null($id_ente)) $req.=" and id_ente='".$db->escapeLikeString($id_ente)."'";
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
}