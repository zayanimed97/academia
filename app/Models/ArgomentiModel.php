<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ArgomentiModel extends Model
{
	
    protected $table = 'argomenti';
	protected $primaryKey = 'idargomenti';
    protected $allowedFields = ['nomeargomento', 'visibile','fotoargomento','testo','url','banned','id_ente'];
	
	protected $returnType = 'array';
	
	public function get_argo_have_cours($corsi_type=null,$id_ente=null){
		$db = \Config\Database::connect();
		$req="select * from ".$this->table." where banned='no' and visibile='1' and idargomenti IN(select id_argomenti from corsi where banned='no' and status='si'";
		if(!is_null($id_ente)) $req.=" and id_ente='".$db->escapeLikeString($id_ente)."'";
		if(!is_null($corsi_type)) $req.=" and tipologia_corsi LIKE '".$db->escapeLikeString($corsi_type)."'";
		 $req.=")";
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	} 
	
}