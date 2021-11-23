<?php namespace App\Controllers;

class Test extends BaseController
{
	public function index()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		if($this->request->getVar('action')!==null){			
			switch($this->request->getVar('action')){
				case 'delete':
					$id=$this->request->getVar('id');
					if($id!=""){
						$this->CorsiModuloTestModel->update($id,array('banned'=>'yes'));
						$success=lang('app.success_delete');
					}
				break;
			}
		}
		$res=array();
		$ll=$this->CorsiModuloTestModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->find();
		foreach($ll as $kk=>$vv){
			$res[]=$vv;
		}
		
		$data['list']=$res;
		return view('admin/corsi_test.php',$data);
	}
	
	public function test_add(){
		$common_data=$this->common_data();
		$data=$common_data;
	
		if($this->request->getVar('type')!==null){
				if(!is_null($this->request->getVar('auto_score'))) $auto_score="yes"; else $auto_score="no";
				if(!is_null($this->request->getVar('enable'))) $enable="yes"; else $enable="no";
						$id_test=$this->CorsiModuloTestModel->insert(array(
									'nb_repeat'=>$this->request->getVar('nb_repeat'),
									'min_points'=>$this->request->getVar('min_points'),
									'id_ente'=>$common_data['user_data']['id'],
									'title'=>$this->request->getVar('title'),
									'ord'=>$this->request->getVar('ord'),
									'auto_score'=>$auto_score,
									'type'=>$this->request->getVar('type'),
									'enable'=>$enable
								)
							);
							
						foreach($this->request->getVar('questions') as $k=>$one_q){
							$nb_reponse=0;
							if($one_q['question_type']!='aperta') $nb_reponse=count($one_q['answers']);
							$id_q=$this->CorsiModuloTestQuestionsModel->insert(array(
								'id_test'=>$id_test,
								'question'=>$one_q['question_title'],
								'type'=>$one_q['question_type'],
								'time'=>$one_q['question_time'],
								'nb_response'=>$nb_reponse
							));
							
							if(!empty($one_q['answers'])){
								foreach($one_q['answers'] as $kk=>$one_r){
									$this->CorsiModuloTestResponsesModel->insert(array(
										'id_q'=>$id_q,
										'response'=>$one_r['answer_title'],
										'points'=>$one_r['answer_points']
									));
	
								}
							}	
							
						}
			$data['success']=lang('app.success_add');
		}
		return view('admin/corsi_test_add.php',$data);
	}
	
	
	public function test_edit($id_test){
		$common_data=$this->common_data();
		$data=$common_data;
		$verify=$this->CorsiModuloTestModel->where('id',$id_test)->where('id_ente',$common_data['user_data']['id'])->first();
		if(empty($verify)) return redirect()->to(base_url('admin/test'));
		if($this->request->getVar('type')!==null){
				if(!is_null($this->request->getVar('auto_score'))) $auto_score="yes"; else $auto_score="no";
				if(!is_null($this->request->getVar('enable'))) $enable="yes"; else $enable="no";
						$this->CorsiModuloTestModel->update($id_test,array(
									'nb_repeat'=>$this->request->getVar('nb_repeat'),
									'min_points'=>$this->request->getVar('min_points'),
									'title'=>$this->request->getVar('title'),
									'ord'=>$this->request->getVar('ord'),
									'auto_score'=>$auto_score,
									'type'=>$this->request->getVar('type'),
									'enable'=>$enable
								)
							);
							
						$ll=$this->CorsiModuloTestQuestionsModel->where('banned','no')->where('id_test',$id_test)->findAll();
						
						foreach($ll as $kk=>$vv){
							$list_responses=$this->CorsiModuloTestResponsesModel->where('id_q',$vv['id'])->findAll();
							foreach($list_responses as $kkk=>$vvv){
								$this->CorsiModuloTestResponsesModel->delete($vvv['id']);
							}
							$this->CorsiModuloTestQuestionsModel->delete($vv['id']);
						}
						foreach($this->request->getVar('questions') as $k=>$one_q){
							$nb_reponse=0;
							if($one_q['question_type']!='aperta') $nb_reponse=count($one_q['answers']);
							$id_q=$this->CorsiModuloTestQuestionsModel->insert(array(
								'id_test'=>$id_test,
								'question'=>$one_q['question_title'],
								'type'=>$one_q['question_type'],
								'time'=>$one_q['question_time'],
								'nb_response'=>$nb_reponse
							));
							
							if(!empty($one_q['answers'])){
								foreach($one_q['answers'] as $kk=>$one_r){
									$this->CorsiModuloTestResponsesModel->insert(array(
										'id_q'=>$id_q,
										'response'=>$one_r['answer_title'],
										'points'=>$one_r['answer_points']
									));
	
								}
							}	
							
						}
			$data['success']=lang('app.success_update');
		}
		$data['inf_test']=$this->CorsiModuloTestModel->where('id',$id_test)->where('id_ente',$common_data['user_data']['id'])->first();
		$list_questions=$this->CorsiModuloTestQuestionsModel->where('banned','no')->where('id_test',$id_test)->findAll();
		
				$data['list_questions']=$list_questions;
				foreach($list_questions as $k=>$one_q){
					$list_responses=$this->CorsiModuloTestResponsesModel->where('id_q',$one_q['id'])->findAll();
					$data['list_responses'][$one_q['id']]=$list_responses;
				}
		return view('admin/corsi_test_edit.php',$data);
	}
	
	public function validation(){
		$common_data=$this->common_data();
		$data=$common_data;
		$error_q_index="";
		if($this->request->getVar('title')=="") $error_msg=lang('app.error_required');
		elseif(null ===$this->request->getVar('questions')){
			$error_msg=lang('app.error_modulo_test_empty');
		}
		else{
			
			foreach($this->request->getVar('questions') as $k=>$one_q){
				
				//var_dump($one_q);
				if($one_q['question_title']=="" || $one_q['question_type']==""){
					$error_msg="<ul>";
					$error_msg.="<li>".lang('app.error_modulo_test_question_required')."</li>";
					$error_msg.="</ul>";
					break;
				}
				elseif($one_q['question_type']!='aperta'){
					$tot_pts=0;
					foreach($one_q['answers'] as $kk=>$one_r){
						$tot_pts+=intval($one_r['answer_points']);
						if($one_r['answer_title']=="" || $one_r['answer_points']==""){
							$error_msg="<ul>";
							$error_msg.="<li>".lang('app.error_modulo_test_answer_required')."</li>";
							$error_msg.="</ul>";
							break;
						}
					}
					if($tot_pts!=100){
						$error_msg="<ul>";
						$error_msg.="<li>".lang('app.error_modulo_test_answer_points')."</li>";
						$error_msg.="</ul>";
						break;
					}
				}
			}
			
			$error_q_index=$k;
		}
		
		if(isset($error_msg)) $res=array("error"=>true,"validation"=>$error_msg,"error_q_index"=>$error_q_index);
		else	$res=array("error"=>false); /* is test to delete */
		echo json_encode($res);
	}
	
}