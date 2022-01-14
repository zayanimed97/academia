<?php namespace App\Controllers;

class Participation extends BaseController
{
	public function index($id_modulo)
	{ 	
		
		$common_data=$this->common_data();
		$data=$common_data;
		$inf_modulo=$this->CorsiModuloModel->where("id_corsi IN(select id from corsi where id_ente='".$common_data['user_data']['id']."')")->where('id',$id_modulo)->first();
		if(empty($inf_modulo)){
			return redirect()->to(base_url('admin/modulo'));
		}
		$data['inf_modulo']=$inf_modulo;
		$inf_doctor=$this->UserProfileModel->where('user_id',$inf_modulo['instructor'])->first();
		$data['inf_doctor']=$inf_doctor['nome'].' '.$inf_doctor['cognome'];
		$inf_corsi=$this->CorsiModel->find($inf_modulo['id_corsi']);
		$data['inf_corsi']=$inf_corsi;
		
		if(!is_null($this->request->getVar('action'))){
				switch($this->request->getVar('action')){
					case 'send_credential_multiple':
						$list_p=$this->request->getVar('id');
						if(!empty($list_p)){
							foreach($list_p as $kk=>$vv){
								if($vv!=""){
									$inf_p=$this->ParticipationModel->find($vv);

									$this->send_credential($inf_p['id_user'],'no');
								}
							}
						}
						$data['success']=lang('app.success_send_credential');
					break;
					case 'send_promo_multiple':
						$list_p=$this->request->getVar('id');
						if(!empty($list_p)){
							foreach($list_p as $kk=>$vv){
								if($vv!=""){
									$inf_p=$this->ParticipationModel->find($vv);
									$this->send_promo($inf_p);
								}
							}
						}
						$data['success']=lang('app.success_send_promo');
						
					break;
				}
		}
		
		
		
		$ll=$this->ParticipationModel->where('banned','no')->where('id_modulo',$id_modulo)->find();
		
		$res=array();
		foreach($ll as $k=>$v){
				
				$inf_user=$this->UserModel->withDeleted()->find($v['id_user']);
				$inf_user_profile=$this->UserProfileModel->where('user_id',$v['id_user'])->first();
			
				
				$v['participante']=$inf_user_profile['nome'];
							
				$v['participant_cognome']=$inf_user_profile['cognome'];
				$v['participante_phone']=$inf_user_profile['mobile'];
				$v['participante_email']=$inf_user_profile['email'];
				$v['credentiel']="User:".$inf_user['email'].'<br>Password:'.$inf_user['pass'].'<br>Cell:'.$inf_user_profile['mobile'];
				if($v['id_date']!==null){
					$inf_date=$this->CorsiModuloDateModel->find($v['id_date']);
					if(!empty($inf_date)) $v['date_session']=$inf_date['date'];
				}
				
				$quota="";
				if($v['id_cart']!=""){
					$inf_cart=$this->CartModel->find($v['id_cart']);
					$inf_payment=$this->CartPaymentModel->where('id_cart',$v['id_cart'])->where('status','COMPLETED')->where('banned','no')->find();
					$total_paid=$inf_cart['total_ht']+$inf_cart['total_vat'];
					if(!empty($inf_payment)) $inf_method=$this->MethodPaymentModel->find($inf_payment[0]['id_method']);
					else $inf_method['title']="--";
					$quota=number_format($total_paid,2,',','.').'€ <br/>'.date('d/m/Y',strtotime($inf_cart['date'])).'<br/>'.$inf_method['title'];
					
				}
				$v['total_paid']=$total_paid;
				
				$v['quota']=$quota;
				$res[]=$v;
			}
		$data['list']=$res;
		if($this->session->get('success')!==null){
			$data['success']=$this->session->get('success');
			$this->session->remove('success');
		}
		return view('admin/corsi_modulo_participation.php',$data);
	}
	
		public function send_credential($id_user,$redirect='no'){
		
		$common_data=$this->common_data();
		
		$user_data=$this->session->get('user_data');
	
			
			
		
			$inf=$this->UserModel->find($id_user);
			
			$inf_profile=$this->UserProfileModel->where('user_id',$id_user)->first();
			$name=$inf_profile['nome'].' '.$inf_profile['cognome'];
			
			$email = \Config\Services::email();
			$email->setFrom($common_data['settings']['sender_email'],$common_data['settings']['sender_name']);
			$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
				if($SMTP!="") $vals=json_decode($SMTP,true);
			
				if(!empty($vals)){
					if(isset($vals['sender_name'])) $sender_name=$vals['sender_name'];
					if(isset($vals['sender_email'])) $sender_email=$vals['sender_email'];
					
					$email->SMTPHost=$vals['host'];
					$email->SMTPUser=$vals['username'];
					$email->SMTPPass=$vals['password'];
					$email->SMTPPort=$vals['port'];
				}
				
			
			
			$email->setTo($inf['email']);
			//$email->setBCC('segreteria@dentalcampus.it');
			$link=base_url('user/login');
			$temp=$this->TemplatesModel->where('module','send_credential')->where('id_ente',$common_data['selected_ente']['id'])->find();
			if(empty($temp)) $temp=$this->TemplatesModel->where('module','send_credential')->where('id_ente IS NULL')->find();
		
			$html=str_replace(array("{var_link}","{var_password}","{var_email}","{var_name}"),
			array($link,$inf['pass'],$inf['email'],$name),
			$temp[0]['html']);
			$email->setSubject($temp[0]['subject']);
			$email->setMessage($html);
			$email->setAltMessage(strip_tags($html));
			$xxx=$email->send();
			
			$yy=$this->NotifLogModel->insert(array('id_participant'=>$id_user,'type'=>'email','user_to'=>$inf['email'],'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		if($redirect=='yes')
			return redirect()->back()->with('success', lang('app.success_send_credential'));
		else return true;
	}
	 ######################################################"
		public function send_promo($infp){
		
		$common_data=$this->common_data();
		$settings=$common_data['settings'];

		//	$inf_participation=$this->ParticipationModel->find($infp['id']);
			$inf=$this->UserModel->find($infp['id_user']);
			$inf_profile=$this->UserProfileModel->where('user_id',$infp['id_user'])->first();
			$name=$inf_profile['nome'].' '.$inf_profile['cognome'];
			$inf_modulo=$this->CorsiModuloModel->find($infp['id_modulo']);
			
			$inf_corsi=$this->CorsiModel->find($inf_modulo['id_corsi']);
			switch($inf_corsi['tipologia_corsi']){
				case 'aula':$module="promo_aula";break;
				case 'online':$module="promo_online";break;
				case 'webinar':$module="promo_webinar";break;
			}
			
			$email = \Config\Services::email();
			$email->setFrom($common_data['settings']['sender_email'],$common_data['settings']['sender_name']);
			$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
				if($SMTP!="") $vals=json_decode($SMTP,true);
			
				if(!empty($vals)){
					if(isset($vals['sender_name'])) $sender_name=$vals['sender_name']; else  $sender_name=common_data['settings']['sender_name'];
					if(isset($vals['sender_email'])) $sender_email=$vals['sender_email']; else  $sender_email=common_data['settings']['sender_email'];
					$email->setFrom($sender_email,$sender_name);
					$email->SMTPHost=$vals['host'];
					$email->SMTPUser=$vals['username'];
					$email->SMTPPass=$vals['password'];
					$email->SMTPPort=$vals['port'];
				}
		
			$email->setTo($inf['email']);

		
			$temp=$this->TemplatesModel->where('module',$module)->where('id_ente',$common_data['selected_ente']['id'])->find();
			if(empty($temp)) $temp=$this->TemplatesModel->where('module',$module)->where('id_ente IS NULL')->find();
			
				ob_start();
			
				$list_date=$this->CorsiModuloDateModel->where('banned','no')->where('id_modulo',$infp['id_modulo'])->orderby('date','ASC')->findAll();
				foreach($list_date as $xdt=>$vdt){
					$list_date_incontro[$vdt['incontro']][]=$vdt;
				}
				
				if(!empty($list_date_incontro)) $tab_incontro=array_keys($list_date_incontro);
				else $tab_incontro=array();
if(!empty($tab_incontro)){				
				  foreach($tab_incontro as $kk=>$v){
					  ?>
				  <p>
				
					<ul>
					<?php foreach($list_date_incontro[$v] as $kkk=>$vv){?>
						<li><?php
						$time = Time::parse($vv['date'], 'Europe/Rome', 'it_IT');
						echo $time->toLocalizedString('d MMM Y'); 
						//echo $vv['date'];
						
						if($vv['start_time']!="") echo ": ".$vv['start_time']; 
						if($vv['end_time']!="") echo " - ".$vv['end_time']; 
						?></li>
					<?php } ?>
					</ul>
				  </p>
				  <?php } 
}?>
			<?php
			
			$corsi_date=ob_get_clean();
			if($inf_modulo['crediti']!="") $ecm="<p><b>ECM:".$inf_modulo['crediti']."</b></p>"; else $ecm="";
			$hotel=""; $sede="";
			if($inf_corsi['tipologia_corsi']=='aula'){
				if($inf_corsi['id_alberghi']!=""){
					$inf_hotel=$this->AlberghiModel->find($inf_corsi['id_alberghi']);
					$sede='<a href="'.$inf_hotel['gmap'].'">'.$inf_hotel['indirizzo'].'</a>';
					$hotel=$inf_hotel['nome'];
					if($inf_corsi['id_luoghi']!=""){
						$inf_luoghi=$this->LuoghiModel->find($inf_corsi['id_luoghi']);
						$hotel.=" ".$inf_luoghi['nome'];
					}
				}
			}

			$link_confirm="<a href='".base_url('confirm_participation_by_mail/'.$infp['id'].'/'.$inf['id'])."'>Conferma partecipazione</a>";
			$email = \Config\Services::email();
			$email->clear(true);	
			
			$z=$email->setFrom($settings['sender_email'],$settings['sender_name']);
		
			$email->setTo($inf['email']);
			
			$link=base_url('user/login');
			
		
			$html=str_replace(array("{CORSI_SOTTO_TITOLO}","{var_cart_details}","{var_password}","{var_email}","{var_name}","{CORSI_DATE}","{var_ecm}","{HOTEL}","{SEDE}","{CONFIRMA_PARTICIPAZIONE}","{var_login_page}"),
			array($inf_corsi['sotto_titolo'],$inf_corsi['titolo'],$inf['pass'],$inf['email'],$name,$corsi_date,$ecm,$hotel,$sede,$link_confirm,$link),
			$temp[0]['html']);
			$email->setSubject($temp[0]['subject']);
			$email->setMessage($html);
			$email->setAltMessage(strip_tags($html));
			$xxx=$email->send();
			
			$yy=$this->NotifLogModel->insert(array('id_participant'=>$infp['id_user'],'type'=>'email','user_to'=>$inf['email'],'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		return true;
		
		
	}
}
?>