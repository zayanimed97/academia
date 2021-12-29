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
					/*if($inf_cart['coupon_discount']!=""){
						$det=json_decode($inf_cart['coupon_discount'],true);
						$inf_coupon=$CouponModel->find($det['coupon_id']);
						$v['coupon']=$inf_coupon['code'];
					}
					if($inf_cart['partial_payment']=='yes'){
							$det=json_decode($inf_cart['partial_payment_details'],true);
							$total_paid=$det['total_topay_partial'];
							
							if(!is_null($inf_cart['second_partial_payment'])){
								$det=json_decode($inf_cart['second_partial_payment'],true);
								$total_paid+=$det['amount'];
							}
						}
					*/
				}
				$v['total_paid']=$total_paid;
				
				$v['quota']=$quota;
				$res[]=$v;
			}
		$data['list']=$res;
		return view('admin/corsi_modulo_participation.php',$data);
	}
	
}
?>