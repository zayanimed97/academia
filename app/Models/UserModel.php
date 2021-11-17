<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UserModel extends Model
{
	
    protected $table = 'users';
	protected $primaryKey = 'id';
    protected $allowedFields = ['role', 'email','password','display_name','active','token','ordring','pass','id_corsi','id_ente','domain_ente'];
	protected $useSoftDeletes = true;
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $createdField  = 'created_at';
	protected $deletedField  = 'deleted_at';
	protected $updatedField  = null;
	
	
	
	public function login($email,$password,$role=null){
		$db = \Config\Database::connect();
		$req="SELECT * FROM ".$this->table." where deleted_at IS NULL ";
		if(!is_null($role)) $req.=" and role='".$role."'";
		if(!is_null($email)) $req.=" and email='".$email."'";
		if(!is_null($password)) $req.=" and password='".md5($password)."'";
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
	
	public function add($role,$email,$password,$display_name,$active,$token='',$id_ente=null,$domain_ente=''){
		$db = \Config\Database::connect();
		$ordring=0;
		$rr="select count(*) as c from ".$this->table." where role='".$role."'";
		$query = $db->query($rr);
		$results = $query->getResultArray();
		$ordring=$results[0]['c']+1;
		 $req="INSERT INTO ".$this->table."(role,email,password,display_name,active,token,ordring,pass,id_ente,domain_ente) VALUES('".$db->escapeString($role)."','".$db->escapeString($email)."','".md5($password)."','".$db->escapeString($display_name)."','".$active."','".$token."','".$ordring."','".$password."','".$id_ente."','".$db->escapeString($domain_ente)."')";
		$query = $db->query($req);
		return $db->insertID();
	}
	
	public function edit($id,$data){
		$db = \Config\Database::connect();
		$req="update ".$this->table." set ";
		foreach($data as $col=>$val){
			$req.=$col."='".$db->escapeString($val)."',";
		}
		 $req=substr($req,0,-1);
		 $req.=" where id='".$id."'";
		$query = $db->query($req);
		return true;
	}
	
	public function activate($id,$active,$token=null){
		$db = \Config\Database::connect();
		$req="update ".$this->table." set active='".$active."'";
		if(!is_null($token)) $req.=",token='".$token."'";
		$req.=" where id='".$id."'";
		$query = $db->query($req);
		return true;
	}
	
	public function search($role=null,$display_name=null,$email=null,$active=null,$cf=null,$id_ente=null){
		/** find data related to variables **/
		$db = \Config\Database::connect();
		$req="SELECT * FROM ".$this->table." where deleted_at is NULL";
		if(!is_null($role)) $req.=" and role='".$role."'";
		if(!is_null($display_name)) $req.=" and display_name LIKE '%".$db->escapeLikeString($display_name)."%' ESCAPE '!'";
		if(!is_null($email)) $req.=" and email LIKE '%".$db->escapeLikeString($email)."%' ESCAPE '!'";		
		if(!is_null($active)) $req.=" and active='".$active."'";
		if(!is_null($id_ente)) $req.=" and id_ente='".$id_ente."'";
		if(!is_null($cf)) $req.=" and id IN (select user_id from user_profile where cf LIKE '%".$db->escapeLikeString($cf)."%' ESCAPE '!')";
		
		//echo $req;
		
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
	
	public function searchWithDelete($role=null,$display_name=null,$email=null,$active=null,$cf=null,$is_deleted=null){
		
		/** find data related to variables **/
		$db = \Config\Database::connect();
		$req="SELECT * FROM ".$this->table." where 1";
		if(!is_null($is_deleted)) $req.=" and deleted_at ".$is_deleted;
		if(!is_null($role)) $req.=" and role='".$role."'";
		if(!is_null($display_name)) $req.=" and display_name LIKE '%".$db->escapeLikeString($display_name)."%' ESCAPE '!'";
		if(!is_null($email)) $req.=" and email LIKE '%".$db->escapeLikeString($email)."%' ESCAPE '!'";		
		if(!is_null($active)) $req.=" and active='".$active."'";
		
		if(!is_null($cf)) $req.=" and id IN (select user_id from user_profile where cf LIKE '%".$db->escapeLikeString($cf)."%' ESCAPE '!')";
		
	//	echo $req;
		
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
	
	public function searchEnte($role=null,$display_name=null,$email=null,$active=null,$id_code=null){
		/** find data related to variables **/
		$db = \Config\Database::connect();
		$req="SELECT * FROM ".$this->table." where deleted_at is NULL";
		if(!is_null($role)) $req.=" and role='".$role."'";
		if(!is_null($display_name)) $req.=" and display_name LIKE '%".$db->escapeLikeString($display_name)."%' ESCAPE '!'";
		if(!is_null($email)) $req.=" and email LIKE '%".$db->escapeLikeString($email)."%' ESCAPE '!'";		
		if(!is_null($active)) $req.=" and active='".$active."'";
		
		if(!is_null($id_code)) $req.=" and id IN (select user_id from ente where id_code LIKE '%".$db->escapeLikeString($id_code)."%' ESCAPE '!')";
	//	echo $req;
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
	
	public function searchByOrdring($role=null,$display_name=null,$email=null,$active=null,$cf=null,$professione=null,$lim=null,$page=1){
		/** find data related to variables **/
		$db = \Config\Database::connect();
		$req="SELECT * FROM ".$this->table." where deleted_at is NULL";
		if(!is_null($role)) $req.=" and role='".$role."'";
		if(!is_null($display_name)) $req.=" and display_name LIKE '%".$db->escapeLikeString($display_name)."%' ESCAPE '!'";
		if(!is_null($email)) $req.=" and email LIKE '%".$db->escapeLikeString($email)."%' ESCAPE '!'";		
		if(!is_null($active)) $req.=" and active='".$active."'";
		
		if(!is_null($cf)) $req.=" and id IN (select user_id from user_profile where cf LIKE '%".$db->escapeLikeString($cf)."%' ESCAPE '!')";
		if(!is_null($professione)) $req.=" and id IN (select user_id from user_profile where professione='".$db->escapeLikeString($professione)."')";
		$req.=" order by ordring ASC";
		if($lim!=null){
			$st=$lim*($page-1);
			$req.=" limit $st, $lim";
		}
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results;
	}
	
	public function count_total($role=null,$display_name=null,$email=null,$active=null,$cf=null,$professione=null){
		$db = \Config\Database::connect();
		$req="SELECT count(*) as c FROM ".$this->table." where deleted_at is NULL";
		if(!is_null($role)) $req.=" and role='".$role."'";
		if(!is_null($display_name)) $req.=" and display_name LIKE '%".$db->escapeLikeString($display_name)."%' ESCAPE '!'";
		if(!is_null($email)) $req.=" and email LIKE '%".$db->escapeLikeString($email)."%' ESCAPE '!'";		
		if(!is_null($active)) $req.=" and active='".$active."'";
		
		if(!is_null($cf)) $req.=" and id IN (select user_id from user_profile where cf LIKE '%".$db->escapeLikeString($cf)."%' ESCAPE '!')";
		if(!is_null($professione)) $req.=" and id IN (select user_id from user_profile where professione='".$db->escapeLikeString($professione)."')";
		$req.=" order by ordring ASC";
		
		$query = $db->query($req);
		$results = $query->getResultArray();
		return $results[0]['c'];
	}
	
	public function restore($id){
		$db = \Config\Database::connect();
		$req="update ".$this->table." set deleted_at=NULL";
		
		$req.=" where id='".$id."'";
		$query = $db->query($req);
		return true;
	}
}