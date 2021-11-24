<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class SettingModel extends Model
{
    protected $table = 'setting';
	protected $primaryKey = 'id';
    protected $allowedFields = ['meta_key', 'meta_value','id_ente'];
	protected $returnType = 'array';
	
	public function getByMetaKey($id_ente=null){
		$res=array();
		$all=$this->findAll();
		if(!is_null($id_ente)) $all=$this->where('id_ente',$id_ente)->orWhere('id_ente is null')->findAll();
		foreach($all as $k=>$v){
			$res[$v['meta_key']]=$v['meta_value'];
		}
		return $res;
	}

		public function updateByMetaKey($meta_key,$meta_value,$id_ente=null){
			$db = \Config\Database::connect();
			 $req="update ".$this->table." set meta_value='".$db->escapeString($meta_value)."' where meta_key='".$meta_key."'";
			 	if(!is_null($id_ente)) $req.=" and id_ente='".$db->escapeLikeString($id_ente)."'";
			$query = $db->query($req);
			return true;
		}
}