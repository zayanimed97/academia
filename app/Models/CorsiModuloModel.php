<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloModel extends Model
{
	
    protected $table = 'corsi_modulo';
	protected $primaryKey = 'id';
    protected $allowedFields = ['banned', 'id_corsi','titolo','sotto_titolo','foto','description','instructor','tipologia','test_required','prezzo','codice','crediti','video_promo','url',
	'obiettivi','programa','note','indrizzato_a','riferimenti','avvisi','seo_title','seo_description','attestato','status','ids_pdf','have_def_price','edition','min_points','ord','free'];
	
	protected $returnType = 'array';
	
	public function search($id_ente,$id_corso=null,$instructor=null,$tipologia_corsi=null,$buy_type=null,$free_modulo=null){
		$db = \Config\Database::connect();
		$req="select * from corsi_modulo where banned='no'";
		if($id_corso!==null) $req.=" and id_corsi='".$db->escapeString($id_corso)."'";
		if($free_modulo!==null) $req.=" and free='".$db->escapeString($free_modulo)."'";
		if($instructor!==null) $req.=" and instructor='".$db->escapeString($instructor)."'";
		$req.=" and id_corsi IN(select id from corsi where banned='no' and id_ente='$id_ente'";
		if($tipologia_corsi!==null) $req.=" and tipologia_corsi='".$db->escapeString($tipologia_corsi)."'";
		if($buy_type!==null) $req.=" and buy_type='".$db->escapeString($buy_type)."'";
		$req.=")";
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
}