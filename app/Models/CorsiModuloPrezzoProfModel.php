<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloPrezzoProfModel extends Model
{
	
    protected $table = 'corsi_modulo_prezzo_prof';
	protected $primaryKey = 'id';
    protected $allowedFields = [ 'id_modulo','prezzo','id_professione'];
	
	protected $returnType = 'array';
	
	public function get_min_price($id_modulo=null){
		$db = \Config\Database::connect();
		$req="select MIN(prezzo) as m from ".$this->table." where 1";
		if(!is_null($id_modulo)) $req.=" and id_modulo='".$id_modulo."'";
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
	
}