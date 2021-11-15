<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloTestModel extends Model
{
	
    protected $table = 'corsi_modulo_test';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_corsi','id_corsi_modulo', 'title','type','auto_score','enable','banned','ord','nb_repeat','min_points'];
	
	protected $returnType = 'array';
	
	public function all_test_done($id_modulo,$id_participation){
		$db = \Config\Database::connect();
		$all_test_done=false;
		 $req="select * from corsi_modulo_test where banned='no' and id_corsi_modulo='".$id_modulo."'";
		$query = $db->query($req);
		$results = $query->getResultArray();
		if(empty($results)){
			$all_test_done=true;
		}
		else{
			$all_test_done=true;
			foreach($results as $k=>$v){
				 $req_exam="select * from corsi_modulo_test_exam where id_test='".$v['id']."' and id_participation='".$id_participation."' and banned='no' and status='success'";
				$query = $db->query($req_exam);
				$results2 = $query->getResultArray();
				if(empty($results2)){
					$all_test_done=false;
					break;
				}
			}
		}
		
		return $all_test_done;
	}
	
	public function all_test_done_corsi($id_corsi,$id_participation){
		$db = \Config\Database::connect();
		$all_test_done=false;
		 $req="select * from corsi_modulo_test where banned='no' and id_corsi='".$id_corsi."' and (id_corsi_modulo IS NULL OR id_corsi_modulo='0' OR id_corsi_modulo='')";
		$query = $db->query($req);
		$results = $query->getResultArray();
		if(empty($results)){
			$all_test_done=true;
		}
		else{
			$all_test_done=true;
			foreach($results as $k=>$v){
				 $req_exam="select * from corsi_modulo_test_exam where id_test='".$v['id']."' and id_participation='".$id_participation."' and banned='no' and status='success'";
				$query = $db->query($req_exam);
				$results2 = $query->getResultArray();
				if(empty($results2)){
					$all_test_done=false;
					break;
				}
			}
		}
		
		return $all_test_done;
	}
}