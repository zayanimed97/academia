<?php namespace App\Controllers;

class Cart extends BaseController
{
	public function index()
	{ 	
		
		$common_data=$this->common_data();
		$data=$common_data;
		if($this->request->getVar('action')!==null){
			switch($this->request->getVar('action')){
				case 'update_status':
					$id=$this->request->getVar('id');
					$status=$this->request->getVar('update_status');
					switch($status){
						case 'COMPLETED':
							
							$this->CartModel->update($id,array('status'=>'COMPLETED'));
							$ll_payment=$this->CartPaymentModel->where('id_cart',$id)->where('banned','no')->where('id_method','1')->where('status','pending')->find();
							if(!empty($ll_payment)){
								foreach($ll_payment as $k=>$v){
									$this->CartPaymentModel->update($v['id'],array('status'=>'COMPLETED'));
								}
							}
							$list_items=$this->CartItemsModel->where('id_cart',$id)->where('banned','no')->find();
							$inf_cart=$this->CartModel->find($id);
							foreach($list_items as $k=>$v){
								switch($v['item_type']){
									case 'corsi':
										$list_modulo=$this->CorsiModuloModel->where('banned','no')->where('status','si')->where('id_corsi',$v['item_id'])->find();
										foreach($list_modulo as $kk=>$vv){
											$this->ParticipationModel->insert(array("id_ente"=>$inf_cart['id_ente'],'id_user'=>$inf_cart['id_user'],'id_modulo'=>$vv['id'],'id_cart'=>$id,'date'=>date('Y-m-d H:i:s')));
										}
									break;
									case 'modulo':
										$det=json_decode($v['details'],true);
										if(isset($det['options']['date']) && $det['options']['date']!==null) $id_date=$det['options']['date'];
										else $id_date=null;
										$this->ParticipationModel->insert(array("id_ente"=>$inf_cart['id_ente'],'id_user'=>$inf_cart['id_user'],'id_modulo'=>$v['item_id'],'id_date'=>$id_date,'id_cart'=>$id,'date'=>date('Y-m-d H:i:s')));
									break;
								}
							}
							
							if(in_array('fatturecloud',$common_data['ente_package']['extra'])){
								ob_clean();
								 $xx=$this->createFattureCloud($id);
								 
							//	 ob_clean();
							 }
							
						break;
						case 'CANCELED':
							$this->CartModel->update($id,array('status'=>'CANCELED'));
							$ll_payment=$this->CartPaymentModel->where('id_cart',$id)->where('banned','no')->where('id_method','1')->where('status','pending')->find();
							if(!empty($ll_payment)){
								foreach($ll_payment as $k=>$v){
									$this->CartPaymentModel->update($v['id'],array('status'=>'CANCELED'));
								}
							}
						break;
					}
					
				break;
			}
		}
		
		$ll=$this->CartModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->find();
		$res=array();
		foreach($ll as $k=>$v){
				
				$inf_user=$this->UserModel->withDeleted()->find($v['id_user']);
				
				$inf_user_profile=$this->UserProfileModel->where('user_id',$v['id_user'])->first();
				//var_dump($inf_user_profile); exit;
				$v['participante']=$inf_user_profile['nome'] ?? "";		
				$v['participant_cognome']=$inf_user_profile['cognome'] ?? "";
				$v['participante_phone']=$inf_user_profile['mobile'] ?? "";
				$v['participante_email']=$inf_user_profile['email'] ?? "";
				$v['credentiel']="User:".$inf_user['email'] ?? ''.'<br>Password:'.$inf_user['pass'].'<br>Cell:'.$inf_user_profile['mobile']?? '';
				
				$quota="";
				
					$inf_payment=$this->CartPaymentModel->where('id_cart',$v['id'])->where('banned','no')->find();
					$total_paid=$v['total_ht']+$v['total_vat'];
					if(!empty($inf_payment)){
						$inf_method=$this->MethodPaymentModel->find($inf_payment[0]['id_method']);
						$v['payment']=$inf_method['icon'];
					}
					else $v['payment']="";
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

	public function abandoned()
	{
		$data=$this->common_data();
		
		$data['cart'] = $this->RememberCartModel->where('remember_cart.id_ente', $data['selected_ente']['id'] ?? '')
												->join('users', 'users.id = remember_cart.id_user')
												->select('remember_cart.*, users.display_name, users.email as user_email')
												->find();

		// foreach ($data['cart'] as $cart) {
			
		// }

		return view('admin/abandoned',$data);

	}
	
}
?>