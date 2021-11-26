<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModel extends Model
{
	
    protected $table = 'corsi';
	protected $primaryKey = 'id';
    protected $allowedFields = ['banned', 'status','url','titolo','foto','id_ente','ids_doctors','id_categorie','id_argomenti','sottoargomenti','tipologia_corsi',
	'inscrizione_aula','nb_person_aula','tipologia_formazione','prezzo','ids_professione','ids_disciplina','seo_title','seo_description','video_promo','id_obiettivo',
	'sotto_titolo','descizione','obiettivi','programa','note','indrizzato_a','riferimenti','avvisi','ids_pdf','have_def_price','vat','slide',
	'test_required','attestato','updated_at','featured','buy_type','stop_next_modulo'];
	
	protected $returnType = 'array';
	
	public function get_corsi_modulo($page=1,$per_page=20,$tipologia_corsi=null,$id_argomenti=null){
		$db = \Config\Database::connect();
		$pager = \Config\Services::pager();
		$req="SELECT c.*  FROM ".$this->table." as c where  c.banned='no' and c.status='si' ";
		//$req="SELECT c.* , m.* FROM ".$this->table." as c,corsi_modulo as m where c.id=m.id_corsi and c.banned='no' and c.status='si' and m.banned='no'";
		//$req="SELECT c.*  FROM ".$this->table." as c inner join corsi_modulo ON c.id=corsi_modulo.id_corsi";
		if(!is_null($tipologia_corsi))  $req.=" and c.tipologia_corsi='".$db->escapeString($tipologia_corsi)."'";
		if(!is_null($id_argomenti))  $req.=" and c.id_argomenti='".$db->escapeString($id_argomenti)."'";
		
		//echo $req;
		$query = $db->query($req);
		 $tot = count($query->getResultArray());
		$st=($page-1)*$per_page;
		 $req.=" limit $st,$per_page";
		
		$query = $db->query($req);
		//echo $tot = $query->countAll();
		$results = $query->getResultArray();
		return array('results'=>$results,'tot'=>$tot);
		//return $this;
	}
	
	public function get_corsi_modulo_mixt($tipologia_corsi=null,$id_argomenti=null,$prezzo=null,$lim=null,$docenti_id=null,$id_luoghi=null,$exclude_corsi_id=null){
		$db = \Config\Database::connect();
		$data=array();
		$req="SELECT c.id  FROM ".$this->table." as c where  c.banned='no' and c.status='si' ";
		
		if(!is_null($tipologia_corsi))  $req.=" and c.tipologia_corsi='".$db->escapeString($tipologia_corsi)."'";
		if(!is_null($id_argomenti))  $req.=" and c.id_argomenti='".$db->escapeString($id_argomenti)."'";
		if(!is_null($id_luoghi))  $req.=" and c.id_luoghi='".$db->escapeString($id_luoghi)."'";
		if(!is_null($prezzo)) $req.=" and c.prezzo <='".$db->escapeString($prezzo)."'";
		if(!is_null($docenti_id))  $req.=" and find_in_set('".$db->escapeString($docenti_id)."',c.ids_doctors)>0";
		if(!is_null($exclude_corsi_id)){
			$req.=" and c.id !='".$db->escapeString($exclude_corsi_id)."'";
		}
		if(!is_null($lim)) $req.=" limit ".$lim;
	
		$query = $db->query($req);
		//echo $tot = $query->countAll();
		$results = $query->getResultArray();
		foreach($results as $k=>$v){
			$row=array("id"=>$v['id'],"type"=>"corsi");
			$data[]=$row;
			$req_mdulo="select * from corsi_modulo where banned='no' and status='si' and id_corsi='".$v['id']."'";
			if(!is_null($prezzo)) $req_mdulo.=" and prezzo <='".$db->escapeString($prezzo)."'";
			//if(!is_null($lim)) $req_mdulo.=" limit ".$lim;
			$query_mdulo = $db->query($req_mdulo);
		
			$results_mdulo = $query_mdulo->getResultArray();
			foreach($results_mdulo as $kk=>$vv){
				$row=array("id"=>$vv['id'],"type"=>"modulo");
				$data[]=$row;
			}
		}
		shuffle ($data);
		return $data;
		//return array('results'=>$results,'tot'=>$tot);
		//return $this;
	}
	
	public function get_featured(){
		$db = \Config\Database::connect();
		$data=array();
		//and( c.tipologia_corsi='AULA' and c.id IN(select id_corsi from corsi_date where DATEDIFF(now(), date)>=7 order by date ASC limit 1))
		 $req="SELECT c.id,c.tipologia_corsi  FROM ".$this->table." as c where  c.banned='no' and c.status='si'";
		$query = $db->query($req);
		//echo $tot = $query->countAll();
		$results = $query->getResultArray();
		foreach($results as $k=>$v){
			$req_date="select * from corsi_date where id_corsi='".$v['id']."' order by date ASC limit 1";
			$query_date = $db->query($req_date);
			$results_date = $query_date->getResultArray();
			
			if($v['tipologia_corsi']=='AULA'){
				if( strtotime($results_date[0]['date'].' 00:00:00')-strtotime(date('Y-m-d'))>=(7*24*60*60) ){
					$data[$v['id']]=$results_date[0]['date'];
				}
			}
			else $data[$v['id']]=$results_date[0]['date'];
		}
	
		asort($data);
		
		$data=array_slice($data, 0, 6,true);
		
		return $data;
	}
	
	public function get_featured_2(){
		$db = \Config\Database::connect();
		$data=array();
		//and( c.tipologia_corsi='AULA' and c.id IN(select id_corsi from corsi_date where DATEDIFF(now(), date)>=7 order by date ASC limit 1))
		 $req="SELECT c.id,c.tipologia_corsi  FROM ".$this->table." as c where  c.banned='no' and c.status='si' and c.featured='yes'";
		$query = $db->query($req);
		//echo $tot = $query->countAll();
		$results = $query->getResultArray();
		foreach($results as $k=>$v){
			$req_date="select * from corsi_date where id_corsi='".$v['id']."' order by date ASC limit 1";
			$query_date = $db->query($req_date);
			$results_date = $query_date->getResultArray();
			
			if($v['tipologia_corsi']=='AULA'){
				if( strtotime($results_date[0]['date'].' 00:00:00')-strtotime(date('Y-m-d'))>=(7*24*60*60) ){
					$data[$v['id']]=$results_date[0]['date'];
				}
			}
			else $data[$v['id']]=$results_date[0]['date'];
		}
	
		asort($data);
		
		$data=array_slice($data, 0, 6,true);
		
		return $data;
	}
}