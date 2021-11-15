<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiPrezzoProfModel extends Model
{
	
    protected $table = 'corsi_prezzo_prof';
	protected $primaryKey = 'id';
    protected $allowedFields = [ 'id_corsi','prezzo','id_professione'];
	
	protected $returnType = 'array';
	
	public function get_min_price($id_corsi=null){
		$db = \Config\Database::connect();
		$req="select MIN(prezzo) as m from ".$this->table." where 1";
		if(!is_null($id_corsi)) $req.=" and id_corsi='".$id_corsi."'";
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
	
}