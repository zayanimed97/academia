<?php namespace App\Controllers;

class DashboardController extends BaseController
{

	// public function __construct()
	// {
	// 	$this->session = \Config\Services::session();
	// 	session()->start();
	// 	return redirect('/login', 'refresh');
	// 	$user_data=$this->session->get('user_data');
	// 	die(var_dump(($user_data['role'] ?? '') != 'user') );
	// 	if(($user_data['role'] ?? '') != 'user') return redirect()->to( base_url('/login') );
	// }
	
	public function show()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
	
		$ht=$this->CartModel->where('id_ente',$common_data['user_data']['id'])->where('status','COMPLETED')->where('banned','no')->selectSum('total_ht')->find();
		$tva=$this->CartModel->where('id_ente',$common_data['user_data']['id'])->where('status','COMPLETED')->where('banned','no')->selectSum('total_vat')->find();
	
		$data['incomes']=number_format($ht[0]['total_ht']+$tva[0]['total_vat'],2,'.','');
		
		$tot_orders=$this->CartModel->where('id_ente',$common_data['user_data']['id'])->where('banned','no')->countAllResults();
		$tot_orders_success=$this->CartModel->where('id_ente',$common_data['user_data']['id'])->where('status','COMPLETED')->where('banned','no')->countAllResults();
		$data['percent_success']=round(100*($tot_orders > 0)?$tot_orders_success/$tot_orders : 0,2);
		$data['tot_orders_success']=$tot_orders_success;
		
		$data['tot_modulo']=$this->CorsiModuloModel->where('banned','no')->where('status','si')->where("id_corsi IN(select id from corsi where banned='no' and status='si' and id_ente='".$common_data['user_data']['id']."')")->countAllResults();
		$data['tot_modulo_buyed']=$this->ParticipationModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->countAllResults();
		
		$data['tot_participant']=$this->UserModel->where('id_ente',$common_data['user_data']['id'])->where('role','participant')->where('active','yes')->countAllResults();
		 $tot=$this->ParticipationModel->where('banned','no')->where('id_ente',$common_data['user_data']['id'])->select('distinct(id_user)')->find();
		
		$data['tot_participant_buyed']=round(100*($data['tot_participant'] > 0) ? count($tot)/$data['tot_participant'] : 0,2);
		
		//$ll=$this->CorsiModuloModel->search($common_data['user_data']['id'],$id_corsi,$instructor,$tipologia_corsi,$buy_type,$free_modulo);
		//where('banned','no')->whereIN("FIND_IN_SET(id_corsi,)>0")
		$ll=$this->CorsiModuloDateModel->where('banned','no')->where("id_modulo IN(select id from corsi_modulo where banned='no' and id_corsi IN(select id from corsi where banned='no' and id_ente='".$common_data['user_data']['id']."') )")
		->where("date >='".date('Y-m-d')."' and date <='".date('Y-m-d',strtotime('+7 days'))."'")->find();
		// 
		$res=array();
		foreach($ll as $kk=>$vv){
			$inf_modulo=$this->CorsiModuloModel->find($vv['id_modulo']);
			$inf_corsi=$this->CorsiModel->find($inf_modulo['id_corsi']);
			
			$inf_modulo['cour']=$inf_corsi['sotto_titolo'];
			$inf_modulo['tipologia_corsi']=$inf_corsi['tipologia_corsi'];
			$luoghi_label="";
			if($inf_corsi['tipologia_corsi']=="aula" && $inf_corsi['id_luoghi']!==null){
				$inf_luoghi=$this->LuoghiModel->find($inf_corsi['id_luoghi']);
				$luoghi_label=$inf_luoghi['nome'] ?? '';
			}
			$inf_modulo['luoghi_label']=$luoghi_label;
			$inf_doctor=$this->UserProfileModel->where('user_id',$inf_modulo['instructor'])->first();
			if(!empty($inf_doctor)) $inf_modulo['instructor']=$inf_doctor['nome'].' '.$inf_doctor['cognome'];
			else $inf_modulo['instructor']="";
			if($inf_modulo['free']=='yes') $inf_modulo['price']=lang('app.field_free_modulo');
			elseif($inf_modulo['have_def_price']=='no'){
				$inf_modulo['price']=lang('app.have_def_price');
			}
			else $inf_modulo['price']=$inf_modulo['prezzo'];
			
			$achat=$this->ParticipationModel->where('banned','no')->where('id_modulo',$inf_modulo['id'])->countAllResults();
			$inf_modulo['achat']=$achat;
			$tab=$inf_modulo;
			$tab['date']=$vv['date'];
			$res[]=$tab;
			
		}
		
		$data['list']=$res;
		
		return view('admin/dashboard.php',$data);
	}

	public function new()
	{
		$this->CategorieModel->insert	([
											'titolo' => $this->request->getVar('name'),
											'status' => 'enable',
											'url' => base_url().'/'.url_title($this->request->getVar('name')),
											'id_ente'=> $this->session->get('user_data')['id']
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}

	public function update()
	{
		$this->CategorieModel->where('id_ente', $this->session->get('user_data')['id'])->update	($this->request->getVar('catId'),[
											'titolo' => $this->request->getVar('name'),
											'url' => base_url().'/'.url_title($this->request->getVar('name')),
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
	
	public function delete($id)
	{
		$this->CategorieModel->where('id_ente', $this->session->get('user_data')['id'])->where('id', $id)->delete();
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
?>
