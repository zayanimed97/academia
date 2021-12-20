<?php namespace App\Controllers;

class Cart extends BaseController
{
	public function index()
	{ 	
		
		$common_data=$this->common_data();
		$data=$common_data;
		
		$ll=$this->CartModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->find();
		$res=array();
		foreach($ll as $k=>$v){
				
				$inf_user=$this->UserModel->withDeleted()->find($v['id_user']);
				$inf_user_profile=$this->UserProfileModel->where('user_id',$v['id_user'])->first();
				$v['participante']=$inf_user_profile['nome'];		
				$v['participant_cognome']=$inf_user_profile['cognome'];
				$v['participante_phone']=$inf_user_profile['mobile'];
				$v['participante_email']=$inf_user_profile['email'];
				$v['credentiel']="User:".$inf_user['email'].'<br>Password:'.$inf_user['pass'].'<br>Cell:'.$inf_user_profile['mobile'];
				
				$quota="";
				
				//	$inf_payment=$this->CartPaymentModel->where('id_cart',$v['id_cart'])->where('status','COMPLETED')->where('banned','no')->find();
					$total_paid=$v['total_ht']+$v['total_vat'];
				//	$inf_method=$this->MethodPaymentModel->find($inf_payment[0]['id_method']);
					//$quota=number_format($total_paid,2,',','.').'€ <br/>'.date('d/m/Y',strtotime($inf_cart['date'])).'<br/>'.$inf_method['title'];
					
				
				$v['total_paid']=$total_paid;
				switch(strtolower($v['status'])){
					case 'pending': $st=lang('app.status_pending'); break;
					case 'completed': $st=lang('app.status_completed'); break;
					case 'canceled': $st=lang('app.status_canceled'); break;
				}
				$v['status_label']=$st;
				$res[]=$v;
			}
		$data['list']=$res;
		return view('admin/cart.php',$data);
	}
	
}
?>