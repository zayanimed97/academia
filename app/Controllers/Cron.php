<?php namespace App\Controllers;
use CodeIgniter\I18n\Time;
class Cron extends BaseController
{
	public function wael(){
		
		$last_date=$this->CorsiModuloDateModel->where('banned','no')->where('id_modulo',8)->orderby('date','DESC')->first();
		
					$target  = new \DateTime(date('Y-m-d'));
					$origin = new \DateTime($last_date['date']);
					$interval = $origin->diff($target);
					 $dd= intval($interval->format('%R%a'));
	}
	public function remember(){
		/*$common_data=$this->common_data();	
		$settings=$common_data['settings'];*/
		$db = \Config\Database::connect();
		
		
		$list=$this->RememberEmailsModel->where('banned','no')->where('enable','yes')->findAll();
	
	
		//$list=$this->RememberEmailsModel->where('id',1)->findAll();
		//var_dump($list);exit;
		foreach($list as $k=>$one_remember){
			$settings=$this->SettingModel->getByMetaKey($one_remember['id']);
			
			$common_data['settings']=$settings;
			
			//$SMTP=$this->SettingModel->getByMetaKeyEnte($one_remember['id'],'SMTP')['SMTP'];
	
		
			
			$inf_ente=$this->UserModel->find($one_remember['id_ente']);
			
			//	var_dump($one_remember['tipologia_corsi']);
			  $nb_days=$one_remember['nb_days'];
			 if($one_remember['tipologia_corsi']!="" && in_array($one_remember['tipologia_corsi'],array('webinar','aula'))){
			 
			$req_corsi="select * from corsi_modulo where banned='no' and status='si' and id_corsi IN(select id from corsi where banned='no' and status='si' and id_ente='".$one_remember['id_ente']."'";
			if($one_remember['tipologia_corsi']!="") $req_corsi.=" and tipologia_corsi='".$one_remember['tipologia_corsi']."'";
			$req_corsi.=")";
			
			
			$query = $db->query($req_corsi);
			$list_corsi = $query->getResultArray();
		
			foreach($list_corsi as $kk=>$one_corsi){
				
				$inf_corsi=$this->CorsiModel->find($one_corsi['id_corsi']);
				
			//	var_dump($inf_corsi);
				$dd=null;
				if($one_remember['type_days']=='before'){
					$first_date=$this->CorsiModuloDateModel->where('banned','no')->where('id_modulo',$one_corsi['id'])->orderby('date','ASC')->first();
					if(!empty($first_date)){
						$origin = new \DateTime(date('Y-m-d'));
						$target = new \DateTime($first_date['date']);
						$interval = $origin->diff($target);
						$dd= intval($interval->format('%R%a'));
					}
				}
				else{ // after
					
					$last_date=$this->CorsiModuloDateModel->where('banned','no')->where('id_modulo',$one_corsi['id'])->orderby('date','DESC')->first();
					if(!empty($last_date)){
						$target  = new \DateTime(date('Y-m-d'));
						$origin = new \DateTime($last_date['date']);
						$interval = $origin->diff($target);
						$dd= intval($interval->format('%R%a'));
					}
				}
				//echo $one_remember['type_days'];
				//echo $one_corsi['id'].' / '.$dd.'<br/>';
				if($dd==$nb_days){ //var_dump($one_corsi);
					$list_p=$this->ParticipationModel->where('banned','no')->where('id_modulo',$one_corsi['id'])->where("(id_date IS NULL  or id_date='0')")->findAll();
					
					$list_docenti=explode(",",$one_corsi['instructor']);
					$docenti="";
					foreach($list_docenti as $one_d){
						$inf_doc=$this->UserModel->find($one_d);
						$docenti.=$inf_doc['display_name'].",";
					}
					$docenti=substr($docenti,0,-1);
					$sede="";$hotel="";
					if($inf_corsi['tipologia_corsi']=='aula'){
						if(intval($inf_corsi['id_luoghi'])>0){
								$inf_l=$this->LuoghiModel->find($inf_corsi['id_luoghi']);
								$sede=$inf_l['nome'];
						}
						if(intval($inf_corsi['id_alberghi'])>0){
							$inf_l=$this->AlberghiModel->find($inf_corsi['id_alberghi']);
							$hotel=$inf_l['nome'];
						}
					}
					$corsi_url=base_url('modulo/'.$one_corsi['url']);
					$confirm_participation_link="";
					
					
					
					
					foreach($list_p as $kkk=>$one_p){
						$inf_user=$this->UserModel->find($one_p['id_user']);
						$confirm_participation_link=base_url('confirm_participation_by_mail/'.$one_p['id'].'/'.$one_p['id_user']);
						$email = \Config\Services::email();
						$sender_name=$settings['sender_name'];
						$sender_email=$settings['sender_email'];
						
						//if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
						$SMTP=$this->SettingModel->getByMetaKeyEnte($one_remember['id_ente'],'SMTP')['SMTP'] ?? '';
							
							if($SMTP!="") $vals=json_decode($SMTP,true);
						
							if(!empty($vals)){
							if(isset($vals['sender_name'])) $sender_name=$vals['sender_name']; else  $sender_name=$common_data['settings']['sender_name'];
					if(isset($vals['sender_email'])) $sender_email=$vals['sender_email']; else  $sender_email=$common_data['settings']['sender_email'];
								
								$email->SMTPHost=$vals['host'];
								$email->SMTPUser=$vals['username'];
								$email->SMTPPass=$vals['password'];
								$email->SMTPPort=$vals['port'];
							}
							
						//}
					$email->setFrom($sender_email,$sender_name);
						 $to=$inf_user['email'];
						$email->setTo($to);
					
					
					 $html=str_replace(array("{CORSI_SOTTO_TITOLO}","{CORSI_URL}","{DATA_INIZIO}","{PARTICIPAZIONI}","{DOCENTI}","{EMAIL}","{PASSWORD}","{SEDE}","{HOTEL}","{CONFIRMA_PARTICIPAZIONE}"),
						array($one_corsi['sotto_titolo'],$corsi_url,date('d/m/Y',strtotime($first_date['date'])),$inf_user['display_name'],$docenti,$inf_user['email'],$inf_user['pass'],$sede,$hotel,$confirm_participation_link),
						$one_remember['text']);
						
						$email->setSubject(str_replace(array("{CORSI_SOTTO_TITOLO}"),array($one_corsi['sotto_titolo']),$one_remember['subject']));
						$email->setMessage($html);
						$email->setAltMessage(strip_tags($html));
						$xxx=$email->send();
						$email->clear();
						$this->NotifLogModel->insert(array('id_participant'=>$inf_user['id'],'type'=>'email','user_to'=>$inf_user['email'],'subject'=>str_replace(array("{CORSI_SOTTO_TITOLO}"),array($one_corsi['sotto_titolo']),$one_remember['subject']),'message'=>$html,'date'=>date('Y-m-d H:i:s')));
					} // end foreach list participant
				}// end days control
				
			} // end foreach list corsi
			
			#############" rest en cas ou achete une date de module #############
			foreach($list_corsi as $kk=>$one_corsi){
				$inf_corsi=$this->CorsiModel->find($one_corsi['id_corsi']);
				
				//$first_date=$this->CorsiModuloDateModel->where('banned','no')->where('id_modulo',$one_corsi['id'])->orderby('date','ASC')->first();
				$list_date=$this->CorsiModuloDateModel->where('banned','no')->where('id_modulo',$one_corsi['id'])->orderby('date','ASC')->find();
			//	var_dump($list_date);
				foreach($list_date as $one_date){
					//var_dump($one_date['date']);
					$dd=null;
					if($one_remember['type_days']=='before'){
						
						$origin = new \DateTime(date('Y-m-d'));
						$target = new \DateTime($one_date['date']);
						$interval = $origin->diff($target);
						$dd= intval($interval->format('%R%a'));
					}
					else{
						$target  = new \DateTime(date('Y-m-d'));
						$origin = new \DateTime($one_date['date']);
						$interval = $origin->diff($target);
						$dd= intval($interval->format('%R%a'));
					}
				//var_dump($dd);
			//	echo $one_corsi['id'].' / '.$dd.'<br/>';
				if($dd==$nb_days){ //var_dump($one_corsi);
					$list_p=$this->ParticipationModel->where('banned','no')->where('id_modulo',$one_corsi['id'])->where('id_date',$one_date['id'])->findAll();
					//var_dump($list_p);
					$list_docenti=explode(",",$one_corsi['instructor']);
					$docenti="";
					foreach($list_docenti as $one_d){
						$inf_doc=$this->UserModel->find($one_d);
						$docenti.=$inf_doc['display_name'].",";
					}
					$docenti=substr($docenti,0,-1);
					$sede="";$hotel="";
					if($inf_corsi['tipologia_corsi']=='aula'){
						if(intval($inf_corsi['id_luoghi'])>0){
								$inf_l=$this->LuoghiModel->find($inf_corsi['id_luoghi']);
								$sede=$inf_l['nome'];
						}
						if(intval($inf_corsi['id_alberghi'])>0){
							$inf_l=$this->AlberghiModel->find($inf_corsi['id_alberghi']);
							$hotel=$inf_l['nome'];
						}
					}
					$corsi_url=base_url('modulo/'.$one_corsi['url']);
					$confirm_participation_link="";
					
					
					
					
					foreach($list_p as $kkk=>$one_p){
						$inf_user=$this->UserModel->find($one_p['id_user']);
						$confirm_participation_link=base_url('confirm_participation_by_mail/'.$one_p['id'].'/'.$one_p['id_user']);
						$email = \Config\Services::email();
						$sender_name=$settings['sender_name'];
						$sender_email=$settings['sender_email'];
						
						//if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
						$SMTP=$this->SettingModel->getByMetaKeyEnte($one_remember['id_ente'],'SMTP')['SMTP'] ?? '';
							if($SMTP!="") $vals=json_decode($SMTP,true);
						
							if(!empty($vals)){
								if(isset($vals['sender_name'])) $sender_name=$vals['sender_name']; else  $sender_name=$common_data['settings']['sender_name'];
					if(isset($vals['sender_email'])) $sender_email=$vals['sender_email']; else  $sender_email=$common_data['settings']['sender_email'];
								
								$email->SMTPHost=$vals['host'];
								$email->SMTPUser=$vals['username'];
								$email->SMTPPass=$vals['password'];
								$email->SMTPPort=$vals['port'];
							}
							
						//}
					$email->setFrom($sender_email,$sender_name);
						 $to=$inf_user['email'];
						$email->setTo($to);
					
				
					 $html=str_replace(array("{CORSI_SOTTO_TITOLO}","{CORSI_URL}","{DATA_INIZIO}","{PARTICIPAZIONI}","{DOCENTI}","{EMAIL}","{PASSWORD}","{SEDE}","{HOTEL}","{CONFIRMA_PARTICIPAZIONE}"),
						array($one_corsi['sotto_titolo'],$corsi_url,date('d/m/Y',strtotime($one_date['date'])),$inf_user['display_name'],$docenti,$inf_user['email'],$inf_user['pass'],$sede,$hotel,$confirm_participation_link),
						$one_remember['text']);
						
						$email->setSubject(str_replace(array("{CORSI_SOTTO_TITOLO}"),array($one_corsi['sotto_titolo']),$one_remember['subject']));
						$email->setMessage($html);
						$email->setAltMessage(strip_tags($html));
						$xxx=$email->send();
						$email->clear();
						$this->NotifLogModel->insert(array('id_participant'=>$inf_user['id'],'type'=>'email','user_to'=>$inf_user['email'],'subject'=>str_replace(array("{CORSI_SOTTO_TITOLO}"),array($one_corsi['sotto_titolo']),$one_remember['subject']),'message'=>$html,'date'=>date('Y-m-d H:i:s')));
					} // end foreach list participant
				}// end days control
			 }// end list date
				
			} // end foreach list corsi
			
			 }//end aula/online corsi
		else{
			
			$list_p=$this->ParticipationModel->where("banned='no' and id_modulo IN (select id from corsi_modulo where banned='no' and status='si' and id_corsi IN(select id from corsi where banned='no' and `status`='si' and tipologia_corsi='".$one_remember['tipologia_corsi']."' and id_ente='".$one_remember['id_ente']."' ) )")->findAll();
			
			foreach($list_p as $kkk=>$one_p){
				$inf_modulo=$this->CorsiModuloModel->find($one_p['id_modulo']);
				
				$inf_corsi=$this->CorsiModuloModel->find($inf_modulo['id_corsi']);
				
				$target  = new \DateTime(date('Y-m-d'));
				$origin = new \DateTime(date('Y-m-d', strtotime($one_p['date'])));
				$interval = $origin->diff($target);
				$dd= intval($interval->format('%R%a'));
				//echo $one_p['id'].' / '.$dd.'<br/>';
				if($dd==$nb_days){
					$one_corsi=$this->CorsiModuloModel->find($one_p['id_modulo']);
					$list_docenti=explode(",",$one_corsi['instructor']);
					$docenti="";
					foreach($list_docenti as $one_d){
						$inf_doc=$this->UserModel->find($one_d);
						$docenti.=$inf_doc['display_name'].",";
					}
					$docenti=substr($docenti,0,-1);
					$sede="";$hotel="";
					/*if($inf_corsi['tipologia_corsi']=='aula'){
						if(intval($inf_corsi['id_luoghi'])>0){
								$inf_l=$this->LuoghiModel->find($inf_corsi['id_luoghi']);
								$sede=$inf_l['nome'];
						}
						if(intval($inf_corsi['id_alberghi'])>0){
							$inf_l=$this->AlberghiModel->find($inf_corsi['id_alberghi']);
							$hotel=$inf_l['nome'];
						}
					}*/
					$corsi_url=base_url('modulo/'.$one_corsi['url']);
					$confirm_participation_link="";
					$inf_user=$this->UserModel->find($one_p['id_user']);
					//	$confirm_participation_link=base_url('confirm_participation_by_mail/'.$one_p['id'].'/'.$one_p['id_user']);
						$email = \Config\Services::email();
						$sender_name=$settings['sender_name'];
						$sender_email=$settings['sender_email'];
						
					//	if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
						$SMTP=$this->SettingModel->getByMetaKeyEnte($one_remember['id_ente'],'SMTP')['SMTP'] ?? "";
							if($SMTP!="") $vals=json_decode($SMTP,true);
						
							if(!empty($vals)){
								if(isset($vals['sender_name'])) $sender_name=$vals['sender_name']; else  $sender_name=$common_data['settings']['sender_name'];
					if(isset($vals['sender_email'])) $sender_email=$vals['sender_email']; else  $sender_email=$common_data['settings']['sender_email'];
								
								$email->SMTPHost=$vals['host'];
								$email->SMTPUser=$vals['username'];
								$email->SMTPPass=$vals['password'];
								$email->SMTPPort=$vals['port'];
							}
							
					//	}
					$email->setFrom($sender_email,$sender_name);
						 $to=$inf_user['email'];
						$email->setTo($to);
					
				
					 $html=str_replace(array("{CORSI_SOTTO_TITOLO}","{CORSI_URL}","{DATA_INIZIO}","{PARTICIPAZIONI}","{DOCENTI}","{EMAIL}","{PASSWORD}","{SEDE}","{HOTEL}","{CONFIRMA_PARTICIPAZIONE}"),
						array($one_corsi['sotto_titolo'],$corsi_url,date('d/m/Y',strtotime($one_p['date'])),$inf_user['display_name'],$docenti,$inf_user['email'],$inf_user['pass'],$sede,$hotel,$confirm_participation_link),
						$one_remember['text']);
						
						$email->setSubject(str_replace(array("{CORSI_SOTTO_TITOLO}"),array($one_corsi['sotto_titolo']),$one_remember['subject']));
						$email->setMessage($html);
						$email->setAltMessage(strip_tags($html));
						$xxx=$email->send();
						$email->clear();
						
						$this->NotifLogModel->insert(array('id_participant'=>$inf_user['id'],'type'=>'email','user_to'=>$inf_user['email'],'subject'=>str_replace(array("{CORSI_SOTTO_TITOLO}"),array($one_corsi['sotto_titolo']),$one_remember['subject']),'message'=>$html,'date'=>date('Y-m-d H:i:s')));
				}
			}				
		}
		} // end list email remember
		
		//var_dump($email);
	} // end function
	
	
}// end class

?>