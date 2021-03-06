<?php
namespace App\Controllers;
use App\Models\ArgomentiModel;
use App\Models\CategorieModel;
use App\Models\ComuniModel;
use App\Models\DisciplineModel;
use App\Models\EntePackageModel;
use App\Models\MethodPaymentModel;
use App\Models\NazioniModel;
use App\Models\NotifLogModel;
use App\Models\ProfessioneModel;
use App\Models\ProvinceModel;
use App\Models\RegioneModel;
use App\Models\SettingModel;
use App\Models\SottoargomentiModel; 
use App\Models\TemplatesModel;
use App\Models\UserCvModel;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\UsersLogModel;
use App\Models\ObiettiviFormazioneModel;
use App\Models\CorsiModel;
use App\Models\CorsiModuloModel;
use App\Models\CorsiGalleriaModel;
use App\Models\CorsiModuloDateModel;
use App\Models\CorsiModuloVimeoModel;
use App\Models\CorsiPDFLibModel;
use App\Models\CorsiPrezzoProfModel;
use App\Models\CorsiModuloPrezzoProfModel;
use App\Models\CorsiModuloTestModel;
use App\Models\CorsiModuloTestQuestionsModel;
use App\Models\CorsiModuloTestResponsesModel;
use App\Models\testModuloModel;
use App\Models\EnteMethodPaymentModel;
use App\Models\CouponModel;
use App\Models\CartModel;
use App\Models\RememberCartModel;
use App\Models\CartItemsModel;
use App\Models\CartPaymentModel;
use App\Models\ParticipationModel;
use App\Models\PagesModel;
use App\Models\AlberghiModel;
use App\Models\LuoghiModel;
use App\Models\ParticipationOnlineStatusModel;
use App\Models\ParticipationOnlineEventModel;
use App\Models\RememberEmailsModel;
use App\Models\UserWalletModel;
use App\Libraries\Fattureincloud;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use Faker\Provider\Base;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form','url','text','language','session','cookie','config'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{

		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->cart = \Config\Services::cart();
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$security = \Config\Services::security();
		$this->session = \Config\Services::session();
		$session = session()->start();
		$this->amount = new \NumberFormatter( 'it_IT', \NumberFormatter::CURRENCY );

		$this->ArgomentiModel =  new ArgomentiModel();
		$this->CategorieModel =  new CategorieModel();
		$this->DisciplineModel =  new DisciplineModel();
		$this->EntePackageModel=new EntePackageModel();

		$this->TemplatesModel =  new TemplatesModel();
		$this->ComuniModel =  new ComuniModel();
		$this->MethodPaymentModel=new MethodPaymentModel();
		$this->NazioniModel =  new NazioniModel();

		$this->NotifLogModel= new NotifLogModel();
		$this->ProfessioneModel =  new ProfessioneModel();
		$this->ProvinceModel =  new ProvinceModel();
		$this->RegioneModel =  new RegioneModel();
		$this->SettingModel =  new SettingModel();
		$this->SottoargomentiModel =  new SottoargomentiModel();
		$this->UserCvModel =  new UserCvModel();
		$this->UserModel =  new UserModel();
		$this->UserProfileModel =  new UserProfileModel();
		$this->UsersLogModel =  new UsersLogModel();
		
		$this->ObiettiviFormazioneModel =  new ObiettiviFormazioneModel();
		$this->CorsiModel =  new CorsiModel();
		$this->CorsiModuloModel =  new CorsiModuloModel();
		$this->CorsiGalleriaModel =  new CorsiGalleriaModel();
		$this->CorsiModuloDateModel =  new CorsiModuloDateModel();
		$this->CorsiModuloVimeoModel =  new CorsiModuloVimeoModel();
		$this->CorsiPDFLibModel =  new CorsiPDFLibModel();
		$this->CorsiPrezzoProfModel =  new CorsiPrezzoProfModel();
		$this->CorsiModuloPrezzoProfModel =  new CorsiModuloPrezzoProfModel();
		$this->CorsiModuloTestModel =  new CorsiModuloTestModel();
		$this->CorsiModuloTestQuestionsModel =  new CorsiModuloTestQuestionsModel();
		$this->CorsiModuloTestResponsesModel =  new CorsiModuloTestResponsesModel();
		$this->TestModuloModel=new testModuloModel();
		$this->EnteMethodPaymentModel=new EnteMethodPaymentModel();
		
		$this->CouponModel=new CouponModel();
		$this->CartModel=new CartModel();
		$this->RememberCartModel=new RememberCartModel();
		$this->CartItemsModel=new CartItemsModel();
		$this->CartPaymentModel=new CartPaymentModel();
		$this->ParticipationModel=new ParticipationModel();
		$this->PagesModel=new PagesModel();
		$this->AlberghiModel=new AlberghiModel();
		$this->LuoghiModel=new LuoghiModel();
		$this->ParticipationOnlineStatusModel=new ParticipationOnlineStatusModel();
		$this->ParticipationOnlineEventModel=new ParticipationOnlineEventModel();
		$this->RememberEmailsModel=new RememberEmailsModel();
		$this->UserWalletModel=new UserWalletModel();
	}
	
	public function common_data(){
		$common_data=array();
		$is_logged=false;
		$user_data=$this->session->get('user_data');	
		if(!empty($user_data)) $is_logged=true;
		$common_data['is_logged']=$is_logged;
		$common_data['user_data']=$user_data;
		
		if(($user_data['role'] ?? '')=='ente'){
			$inf_package=$this->EntePackageModel->where('id_ente',$user_data['id'])->orderBy('expired_date','DESC')->first();
			$det=json_decode($inf_package['package'],true);
			$common_data['ente_package']=array("expired_date"=>$inf_package['expired_date'],"type_cours"=>$det['type_cours'],"extra"=>$det['extra']);
		}
		
		$selected_ente=$this->UserModel->where('role','ente')->where('domain_ente',$_SERVER['SERVER_NAME'] ?? 'localhost')->first();
		if(!empty($selected_ente)){
			$common_data['selected_ente']=$selected_ente;
			if($selected_ente['domain_ente']=='localhost' || $selected_ente['domain_ente']=='' || !file_exists(APPPATH.'Views/'.$selected_ente['domain_ente'])) $common_data['view_folder']='default';
			else $common_data['view_folder']=$selected_ente['domain_ente'];
			
			$inf_package=$this->EntePackageModel->where('id_ente',$selected_ente['id'])->orderBy('expired_date','DESC')->first();
			$det=json_decode($inf_package['package'],true);
			$common_data['ente_package']=array("expired_date"=>$inf_package['expired_date'],"type_cours"=>$det['type_cours'],"extra"=>$det['extra']);
			$list_static_pages=$this->PagesModel->where('type','dynamic')->where('banned','no')->where('enable','yes')->where('id_ente',$selected_ente['id'])->orderBy('ord',"ASC")->find();
			$common_data['list_static_pages']=$list_static_pages;
			$contact_page=$this->PagesModel->where('url','contact')->where('id_ente',$selected_ente['id'])->first();
			$common_data['contact_page']=$contact_page;
		}
		else $selected_ente['id']=null;
		$settings=$this->SettingModel->getByMetaKey($selected_ente['id']);
		$common_data['settings']=$settings;
		//var_dump($common_data['settings']);
		$user_loginas=$this->session->get('user_loginas');	
		if(!empty($user_loginas)) $common_data['user_loginas']=$user_loginas;
		// query to extract idEnte from server name 

		$common_data['CategorieModel'] = $this->CategorieModel;
		$common_data['CorsiModel'] = $this->CorsiModel;
		$common_data['ArgomentiModel'] = $this->ArgomentiModel;
		$common_data['CorsiPrezzoProfModel'] = $this->CorsiPrezzoProfModel;
		$common_data['UserProfileModel'] = $this->UserProfileModel;
		$common_data['amount'] = $this->amount;
		$common_data['discounts'] = function(&$course, $discounts){$this->discounts($course, $discounts);};

		
		if(!is_null($this->session->get('login_as'))){
			$common_data['is_admin']=true;
			$inf_loginas_user=$this->UserModel->find($this->session->get('login_as'));
			if($inf_loginas_user['role']=='ente') $common_data['redirect_admin']=base_url('admin/loginBack');
			else $common_data['redirect_admin']=base_url('superadmin/loginBack');//$this->session->get('redirect_admin');
		}

		$common_data['cart'] = $this->cart;
		$common_data['tax'] = 0;
		foreach ($common_data['cart']->contents() as $item) {
            if ($item['price'] != 'ND') {
                $common_data['tax'] += round($item['price']*0.22, 2);
            }
        }
		return $common_data;
	}
	
	public function crop_image($path,$new_width=500,$new_height=500){
		try {
		$info = \Config\Services::image('imagick')
										->withFile($path)
										->getFile()
										->getProperties(true);

							$xOffset = ($info['width'] / 2) - 25;
							$yOffset = ($info['height'] / 2) - 25;

							\Config\Services::image()
										->withFile($path)
										->crop($new_width, $new_height, $xOffset, $yOffset)
										->save($path);
		}
		catch (CodeIgniter\Images\ImageException $e)
		{
			echo $e->getMessage();
		}
	}

	public function discounts(&$course, $discount)
	{
		$filter = array_filter($discount ?? [], function($el) use ($course) {return ($el['id_corsi'] ?? '') == $course['id'];});

            // calculate max price with default included
            if ($course['have_def_price'] == 'yes') {
                $course['max_price'] = intval($course['max_price']) > intval($course['prezzo']) ? $course['max_price'] : $course['prezzo'];
                $course['min_price'] = intval($course['min_price']) < intval($course['prezzo']) ? $course['min_price'] : $course['prezzo'];
            }

            if (empty($filter) && $course['have_def_price'] == 'no') {
                $course['prezzo'] = '';
            }

            // if there is no user return range
            if (((session('user_data')['role'] ?? '') != 'participant') && strlen($course['max_price']) > 0 && strlen($course['min_price']) > 0) {
                if (floatVal($course['min_price']) == floatVal($course['max_price'])) {
					$course['prezzo'] = $course['min_price'];
				} else {
					$course['prezzo'] = $this->amount->format($course['min_price']). ' - '. $this->amount->format($course['max_price']);
				}
            }

            // if there is a user return price for profession
            if (!empty($filter) && $course['free'] == 'no') {
                $course['prezzo'] = $this->amount->format(reset($filter)['prezzo']);
            }

            

            // if free return gratuito
            $course['prezzo'] = $course['free'] == 'yes' ? lang('front.field_free') : ((strpos($course['prezzo'], '???') || $course['prezzo'] == "") ? $course['prezzo'] : $this->amount->format($course['prezzo']));
	}

	public function updateCart()
	{
		$cartItems = $this->cart->contents();
		$corsi_in_cart = array_filter(array_map(function($el){if($el['type'] == 'corsi') return str_replace($el['type'], '', $el['id']);}, $cartItems));

		$modulo_in_cart = array_filter(array_map(function($el){if($el['type'] == 'modulo') return str_replace($el['type'], '', $el['id']);}, $cartItems));


		$corsi=null;
		$modulo=null;
		if(!empty( $corsi_in_cart)) $corsi = $this->CorsiModel->whereIn('corsi.id', $corsi_in_cart ?: ['empty value for init']);
		if(!empty( $modulo_in_cart)) $modulo = $this->CorsiModuloModel->whereIn('corsi_modulo.id', $modulo_in_cart ?: ['empty value for init']);

		$withPriceProfession = '';
		if (((session('user_data')['role'] ?? '') == 'participant') && (strlen(session('user_data')['profile']['profession'] ?? '') > 0)){
			$withPriceProfession = ', prezz.prezzo as price_for_prof';
			
			if(!empty( $corsi_in_cart))$corsi->join('corsi_prezzo_prof prezz', 'prezz.id_corsi = corsi.id AND prezz.id_professione = '.session('user_data')['profile']['professione'], 'left')->groupBy('corsi.id');
			if(!empty( $modulo_in_cart))$modulo->join('corsi_modulo_prezzo_prof prezz', 'prezz.id_modulo = corsi_modulo.id AND prezz.id_professione = '.session('user_data')['profile']['professione'], 'left')->groupBy('corsi_modulo.id');
		}
		if(!empty( $corsi_in_cart))	$corsi = $corsi->select('corsi.id, corsi.prezzo, corsi.free, corsi.have_def_price'.$withPriceProfession)->find();
		if(!empty( $modulo_in_cart)) $modulo = $modulo->select('corsi_modulo.id, corsi_modulo.prezzo, corsi_modulo.free, corsi_modulo.have_def_price'.$withPriceProfession)->find();


		if (is_array($corsi)) {	
			foreach ($corsi_in_cart as $key => $item) {
				$filter = array_filter($corsi, function($el) use ($item){return $el['id'] == str_replace('corsi', '', $item);});
				$thiscorsi = reset($filter);
				$prezzo = ($thiscorsi['free'] == 'yes')  
															? 0  
															: (($thiscorsi['price_for_prof'] ?? false) 
																? $thiscorsi['price_for_prof'] 
																: (($thiscorsi['have_def_price'] == 'yes') 
																	? $thiscorsi['prezzo'] 
																	: 'ND'));
				$this->cart->update(['rowid' => $key, 'price' => $prezzo]);
			}
		}

		if (is_array($modulo)) {	
			foreach ($modulo_in_cart as $key => $item) {
				$filter = array_filter($modulo, function($el) use ($item){return $el['id'] == str_replace('modulo', '', $item);});
				$thismodulo = reset($filter);
				$prezzo = ($thismodulo['free'] == 'yes') 
															? 0 
															: (($thismodulo['price_for_prof'] ?? false) 
																? $thismodulo['price_for_prof'] 
																: (($thismodulo['have_def_price'] == 'yes') 
																	? $thismodulo['prezzo'] 
																	: 'ND'));
				$this->cart->update(['rowid' => $key, 'price' => $prezzo, 'originalPrice' => $prezzo]);
			}
		}
		

		// echo '<pre>';
        // // print_r($this->cart->contents());
        // print_r($corsi);
        // echo '</pre>';
        // exit;

	}
	public function createFattureCloud($id_cart){
		
		$common_data=$this->common_data();
		$inf_cart=$this->CartModel->find($id_cart);
		$inf_ente=$this->UserModel->find($common_data['selected_ente']['id']);
		
		if(isset($common_data['settings']['fattura_incloud']) && $common_data['settings']['fattura_incloud']!=""){
				$fattura_incloud=json_decode($common_data['settings']['fattura_incloud'],true);
				$Fattureincloud=new Fattureincloud($fattura_incloud['id'] ?? '',$fattura_incloud['key'] ?? '');
				$verify_params=json_decode($Fattureincloud->verify($fattura_incloud['id'] ?? '',$fattura_incloud['key'] ?? ''),true);
				if(isset($verify_params['error_code'])){
					$email = \Config\Services::email();
					$sender_name=$common_data['settings']['sender_name'];
					$sender_email=$common_data['settings']['sender_email'];
					$email->setFrom($sender_email,$sender_name);
						
					//$email->setTo($inf_ente['email']);
					$email->setTo('procreagency@gmail.com');
					$email->setSubject("Error Fatture InCloud via Auledigitale");
					$html=json_encode($verify_params,true)."<hr/> Cart ID:".$id_cart;
					$email->setMessage($html);
					$email->setAltMessage(strip_tags($html));
					$xxx=$email->send();
					return false;
				}
				else{
					
					$inf_profile=$this->UserProfileModel->where('user_id',$inf_cart['id_user'])->first();
					
					 $filter=array();
					 if($inf_profile['type']=='company'){
						 $filter['piva']=$inf_profile['fattura_piva'];
						 $nome=$inf_profile['ragione_sociale'];
					 }
					 else {
						 $filter['cf']=$inf_profile['fattura_cf'];
						 $nome=$inf_profile['fattura_nome'].' '.$inf_profile['fattura_cognome'];
					 }
					 
					 $exist_cloud_client=json_decode($Fattureincloud->clientInfo($filter),true);
					 $fattura_comune="";$fattura_provincia="";
					$inf_pays=$this->NazioniModel->find($inf_profile['fattura_stato']);
						if($inf_profile['fattura_stato']==106){
							$inf_provincia=$this->ProvinceModel->find($inf_profile['fattura_provincia']);
							$fattura_provincia=$inf_provincia['prov'];
							$inf_provincia=$this->ComuniModel->find($inf_profile['fattura_comune']);
							$fattura_comune=$inf_provincia['comune'];
						}
						else{
							$fattura_provincia=strtoupper(substr($inf_profile['fattura_provincia'],0,2)); 
							$fattura_comune=$inf_profile['fattura_comune'];
						}
					$post_client=array("nome"=>$nome,"indirizzo_via"=>$inf_profile['fattura_indirizzo'],"indirizzo_cap"=>$inf_profile['fattura_cap'],"indirizzo_citta"=>$fattura_comune,"indirizzo_provincia"=>$fattura_provincia,"paese"=>$inf_pays['nazione'],"paese_iso"=>$inf_pays['tid'],"tel"=>$inf_profile['fattura_phone']);
					
					switch($inf_profile['type']){
						case 'private': 
							$post_client['cf']=$inf_profile['fattura_cf'];
							$post_client['mail']=$inf_profile['email'];
							$PA=false;
						break;
						case 'professional': 
							$post_client['cf']=$inf_profile['fattura_cf'];
							$post_client['piva']=$inf_profile['fattura_piva'];
							$PA=true;
						break;
						case 'company': 
							$post_client['piva']=$inf_profile['fattura_piva'];
							$PA=true;
						break;
					}
					
					//var_dump($post_client);
					#### step 1: create new client or get client data #######
					if(empty($exist_cloud_client['lista_clienti'])){
						$newclient=json_decode($Fattureincloud->newClient($post_client),true);
						if($newclient['success']==true){
							$post_invoice=$post_client;
							$post_invoice['id_cliente']=$newclient['id'];
						}else{
							$post_invoice=$post_client;
						}
					}
					else{
						$post_invoice=$post_client;
						$post_invoice['id_cliente']=$exist_cloud_client['lista_clienti'][0]['id'];
					}
					
					#### step 2: default invoice data #######
					$post_invoice['autocompila_anagrafica']=false;
					$post_invoice['salva_anagrafica']=true;
				
					$post_invoice['data']=date('d/m/Y');
					$post_invoice['prezzi_ivati']=false;
					
					$post_invoice['PA']=$PA;
					if($PA==true){
						$post_invoice['PA_tipo_cliente']='B2B';
						$post_invoice['PA_codice']=$inf_profile['fattura_sdi'];
						$post_invoice['PA_pec']=$inf_profile['fattura_pec'];
					}
					if($fattura_incloud['num_prefix']!==null) $post_invoice['numero']=$fattura_incloud['num_prefix'];
					
					#### step 3: get invoice items & payments #######
					$list_items=$this->CartItemsModel->where('id_cart',$id_cart)->where('banned','no')->find();
					foreach($list_items as $k=>$one_item){
						$details=json_decode($one_item['details'],true);
						$art_name=$details['name'] ?? 'Corso '.$one_item['item_type'].'#'.$one_item['item_id'].'_'.$one_item['id'];
						$qty=1;
						$prix_net=$one_item['price_ht'];//$v['price']-(floatval($details['totals']['discount'])/$qty);
						$prix_ttc=$prix_net*(1+($one_item['vat']/100));
						
						$post_invoice['lista_articoli'][$k]=[
							"prezzo_netto" =>$prix_net,
							"prezzo_lordo" => $prix_ttc,
							"nome" => $art_name, 
							"cod_iva" => 0,
							"quantita"=>$qty
						];                                  
					}
					$list_payment=$this->CartPaymentModel->where('id_cart',$id_cart)->where('banned','no')->where('status','COMPLETED')->find();
					foreach($list_payment as $kk=>$vv){
						$post_invoice['lista_pagamenti'][]=[ 		
							"importo" => $vv['amount'], 
							"data_scadenza" => date('d/m/Y',strtotime($vv['date'])), 
							"metodo" => "not",
							'data_saldo'=>date('d/m/Y',strtotime( 'today')) 
						];
					}
				
					$data=json_decode($Fattureincloud->newInvoice($post_invoice),true);
					
					if(isset($data['error_code'])){
						$email = \Config\Services::email();
						$sender_name=$common_data['settings']['sender_name'];
						$sender_email=$common_data['settings']['sender_email'];
						$email->setFrom($sender_email,$sender_name);
							
						//$email->setTo($inf_ente['email']);
					$email->setTo('procreagency@gmail.com');
						$email->setSubject("Error Fatture InCloud via Auledigitale");
						$html=json_encode($verify_params,true)."<hr/> Cart ID:".$id_cart;
						$email->setMessage($html);
						$email->setAltMessage(strip_tags($html));
						//var_dump($email);
						$xxx=$email->send();
						return false;
					}
					else{
						$this->CartModel->update($id_cart,array("fattureincloud"=>json_encode($data,true)));
						$pdf=$Fattureincloud->getPdf($data['new_id']);
						$temp=$this->TemplatesModel->where('module','invoice')->where('id_ente',$inf_cart['id_ente'])->find();
						if(empty($temp)) $temp=$this->TemplatesModel->where('module','invoice')->where('id_ente IS NULL')->find();
						$email = \Config\Services::email();
						$sender_name=$common_data['settings']['sender_name'];
						$sender_email=$common_data['settings']['sender_email'];
					
						if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
						$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'] ?? "";
							if($SMTP!="") $vals=json_decode($SMTP,true);
						
							if(!empty($vals)){
									if(isset($vals['sender_name'])  && $vals['sender_name']!="") $sender_name=$vals['sender_name']; else $sender_name=$common_data['settings']['sender_name'];
									if(isset($vals['sender_email']) && $vals['sender_email']!="") $sender_email=$vals['sender_email']; else $sender_email=$common_data['settings']['sender_email'];
					
								$email->SMTPHost=$vals['host'];
								$email->SMTPUser=$vals['username'];
								$email->SMTPPass=$vals['password'];
								$email->SMTPPort=$vals['port'];
							}
							
						}
							$email->setFrom($sender_email,$sender_name);
						$inf_user=$this->UserModel->find($inf_cart['id_user']);
						$email->setTo($inf_user['email']);
						$email->setCc($inf_ente['email']);
						$email->setSubject($temp[0]['subject']);
						
						$html=str_replace(array("{var_user_name}","{pdf_link}"),
					array($inf_profile['nome'].' '.$inf_profile['cognome'],$pdf),
					$temp[0]['html']);
						
						$email->setMessage($html);
						$email->setAltMessage(strip_tags($html));
						
						$xxx=$email->send();
						return true;
					}
				} // end verify params
		
		} // end exist params
		else return false;
	}
 function OrderMail($id_cart){
		$common_data=$this->common_data();
		$inf_cart=$this->CartModel->where('banned','no')->where('id',$id_cart)->first();
		if(!empty($inf_cart)){
			$list_items=$this->CartItemsModel->where('banned','no')->where('id_cart',$id_cart)->find();
			$list_payment=$this->CartPaymentModel->where('banned','no')->where('id_cart',$id_cart)->find();
			$inf_participant=$this->UserModel->where('id',$inf_cart['id_user'])->first();
			
			$inf_profile=$this->UserProfileModel->where('user_id',$inf_cart['id_user'])->first();
			//$inf_payment=$this->MethodPaymentModel->find($inf_cart['payment_method']);
			//$temp=$this->TemplatesModel->where('module','order')->find();
			$temp=$this->TemplatesModel->where('module','order')->where('id_ente',$inf_cart['id_ente'])->find();
			
			
			$discount_row='';
			$total_tax='';
			$payment_status='';
			switch(strtolower($inf_cart['status'])){
				case 'completed': $payment_status=lang('front.status_completed'); break;
				case 'canceled': $payment_status=lang('front.status_canceled'); break;
				default: $payment_status=lang('front.status_pending'); break;
			}
			$coupon='';
			$invoice_data='';
			$cart_items='';
			$payment_details='';
			ob_start();
		 $inf_stato=$this->NazioniModel->find($inf_profile['fattura_stato']);
		 if($inf_profile['fattura_stato']==106){
				$inf_provincia=$this->ProvinceModel->find($inf_profile['fattura_provincia']);
				$inf_comune=$this->ComuniModel->find($inf_profile['fattura_comune']);
			}else{
				$inf_provincia['provincia']=$inf_profile['fattura_provincia'];
				$inf_comune['comune']=$inf_profile['fattura_comune'];
			}
			?>
		<table style="color:#888;">
			<?php if($inf_profile['type']=="company"){?><tr><td><?php echo $inf_profile['ragione_sociale'];?></td></tr><?php }else{?>
			<tr><td><?php echo $inf_profile['fattura_nome'].' '.$inf_profile['fattura_cognome'];?></td></tr><?php } ?>
			<tr><td><?php echo $inf_profile['fattura_indirizzo'].' '.$inf_comune['comune'].' ('.$inf_provincia['provincia'].')';?></td></tr>
				<tr><td><?php echo $inf_profile['fattura_cap'].' '.$inf_stato['nazione'];?></td></tr>
		<?php if($inf_profile['type']!="private"){?>	<tr><td><b><?php echo lang('app.field_iva')?>: </b><?php echo $inf_profile['fattura_piva'];?></td></tr><?php } 
			?><tr><td><b><?php echo lang('app.field_cf')?>: </b><?php echo $inf_profile['fattura_cf'];?></td></tr>
			
			<tr><td><b><?php echo lang('app.field_pec')?>: </b><?php echo $inf_profile['fattura_pec'];?></td></tr>
			<tr><td><b><?php echo lang('app.field_sdi')?>: </b><?php echo $inf_profile['fattura_sdi'];?></td></tr>
			<tr><td><b><?php echo lang('app.field_phone')?>: </b><?php echo $inf_profile['fattura_phone'];?></td></tr>
		</table>
		 
		 <?php $invoice_data=ob_get_clean();
		 ob_start();
		 
		 ?>
		 
		 <table style="color:#888;">
		 <tr>	
			<th><?php echo lang('front.field_method_payment')?></th>
			<th><?php echo lang('front.field_amount')?></th>
			<th><?php echo lang('front.field_date')?></th>
			<th><?php echo lang('front.field_status')?></th>
		 </tr>
			<?php foreach($list_payment as $k=>$v){
				$inf_payment=$this->EnteMethodPaymentModel->where('banned','no')->where('id_ente',$inf_cart['id_ente'])->where('id_method',$v['id_method'])->first();
				$inf_method=$this->MethodPaymentModel->find($v['id_method']);?>
			<tr>
				<td><?php echo $inf_method['title']?>
				<?php if($v['id_method']==1){
					$det=json_decode($inf_payment['details'],true);
					?><br/>
					<b><?php echo lang('front.field_bank_name')?>:</b><?php echo $det['bank_name']?><br/>
					<b><?php echo lang('front.field_iban')?>:</b><?php echo $det['iban']?><br/>
					<b><?php echo lang('front.field_bank_property')?>:</b><?php echo $det['property']?><br/>
				<?php
				}?></td>
				<td><?php echo number_format($v['amount'],2,',','.')?>???</td>
				<td><?php echo date('d/m/Y',strtotime($v['date']))?></td>
				<td><?php switch(strtolower($v['status'])){
				case 'completed': echo lang('front.status_completed'); break;
				case 'canceled':echo lang('front.status_canceled'); break;
				default: echo lang('front.status_pending'); break;
			}}?></td>
			</tr>
		 </table>
		 <?php
		 $payment_details=ob_get_clean();
		 $settings=$common_data['settings'];
		 ob_start();?>
		 <table style="width:100% !important; border:1px solid #a1a1a1;">
    <tbody>
        <tr style="border-bottom:1px solid #a1a1a1;">
            <th>Codice</th>
            <th>Descrizione</th>
            <th>Prezzo</th>
            <th>Docente</th>
        </tr>
       
   
		 <?php
		  if(!empty($list_items)){
				foreach($list_items as $k=>$one){
					switch($one['item_type']){
						case 'corsi':
							$inf_item=$this->CorsiModel->find($one['item_id']);
							$url=base_url('corsi/'.$inf_item['url']);
							$tt=explode(",",$inf_item['ids_doctors']);
							$str_date="";
							$str_docente="";
							foreach($tt as $kk=>$vv){
								$inf_docente=$this->UserProfileModel->where('user_id',$vv)->first();
								$str_docente.=$inf_docente['nome'].' '.	$inf_docente['nome'].',';
							}
							$str_docente=substr($str_docente,0,-1);
							if($inf_item['foto']!="") $foto=base_url('uploads/corsi/'.$inf_item['foto']);
							else{
								$foto=base_url('front/assets/images/courses/img-4.jpg');
								switch($inf_item['tipologia_corsi']){
									case 'online': if(($settings['default_img_online'] ?? '')!="") $foto=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if(($settings['default_img_aula']??'')!="") $foto=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if(($settings['default_img_webinar'] ?? '')!="") $foto=base_url('uploads/'.$settings['default_img_webinar']); break;
								}
							}
							if($inf_item['tipologia_corsi']!='online'){
								$start_date=$this->CorsiModuloDateModel->where("id_modulo IN (select id from corsi_modulo where banned='no' and status='si' and id_corsi='".$one['item_id']."')")->where('banned','no')->orderBy('date','ASC')->first();
								$end_date=$this->CorsiModuloDateModel->where("id_modulo IN (select id from corsi_modulo where banned='no' and status='si' and id_corsi='".$one['item_id']."')")->where('banned','no')->orderBy('date','DESC')->first();
								if(!empty($start_date) && !empty($end_date))$str_date=lang('front.field_de')." ".date('d/m/Y H:i',strtotime($start_date['date'].' '.$start_date['start_time']))." ".lang('front.field_a')." ".date('d/m/Y H:i',strtotime($end_date['date'].' '.$end_date['end_time']));
							}
						break;
						case 'modulo':
							$inf_item=$this->CorsiModuloModel->find($one['item_id']);
							$url=base_url('modulo/'.$inf_item['url']);
							$inf_corsi=$this->CorsiModel->find($inf_item['id_corsi']);
							$inf_docente=$this->UserProfileModel->where('user_id',$inf_item['instructor'])->first();
							$str_docente=($inf_docente['nome'] ?? '').' '.	($inf_docente['nome'] ?? '');
							if($inf_item['foto']!="") $foto=base_url('uploads/corsi/'.$inf_item['foto']);
							else{
								$foto=base_url('front/assets/images/courses/img-4.jpg');
								switch($inf_corsi['tipologia_corsi']){
									case 'online': if(($settings['default_img_online']??'')!="") $foto=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if(($settings['default_img_aula']??'')!="") $foto=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if(($settings['default_img_webinar'] ?? '')!="") $foto=base_url('uploads/'.$settings['default_img_webinar']); break;
								}
							}
							$str_date="";
							$start_date=$this->CorsiModuloDateModel->where('id_modulo',$one['item_id'])->where('banned','no')->orderBy('date','ASC')->first();
							$end_date=$this->CorsiModuloDateModel->where('id_modulo',$one['item_id'])->where('banned','no')->orderBy('date','DESC')->first();
							if($inf_corsi['tipologia_corsi']!='online')
								$str_date=lang('front.field_de')." ".date('d/m/Y H:i',strtotime($start_date['date'].' '.$start_date['start_time']))." ".lang('front.field_a')." ".date('d/m/Y H:i',strtotime($end_date['date'].' '.$end_date['end_time']));
						break;
						case 'date':
							$inf_date=$this->CorsiModuloDateModel->find($one['item_id']);
							$inf_item=$this->CorsiModuloModel->find($inf_date['id_modulo']);
							$url=base_url('modulo/'.$inf_item['url']);
							$inf_docente=$this->UserProfileModel->where('user_id',$inf_item['instructor'])->first();
							$str_docente=$inf_docente['nome'].' '.	$inf_docente['nome'];
							$inf_corsi=$this->CorsiModel->find($inf_item['id_corsi']);
							if($inf_item['foto']!="") $foto=base_url('uploads/corsi/'.$inf_item['foto']);
							else{
								$foto=base_url('front/assets/images/courses/img-4.jpg');
								switch($inf_corsi['tipologia_corsi']){
									case 'online': if($settings['default_img_online']!="") $foto=base_url('uploads/'.$settings['default_img_online']); break;
									case 'aula': if($settings['default_img_aula']!="") $foto=base_url('uploads/'.$settings['default_img_aula']); break;
									case 'webinar': if($settings['default_img_webinar']!="") $foto=base_url('uploads/'.$settings['default_img_webinar']); break;
								}
							}
							$str_date=lang('front.field_de')." ".date('d/m/Y H:i',strtotime($inf_date['date'].' '.$inf_date['start_time']))." ".lang('front.field_a')." ".date('d/m/Y H:i',strtotime($inf_date['date'].' '.$inf_date['end_time']));
						break;
					}						
										 ?>
										  <tr>
            <td style="border-right:1px solid #a1a1a1;"><?php echo $inf_item['codice'] ?></td>
            <td style="border-right:1px solid #a1a1a1;"><b><?php echo $inf_item['sotto_titolo']?></b><br><?php echo $str_date;?></td>
            <td style="border-right:1px solid #a1a1a1;"><b><?php echo $one['price_ht']?></b></td>
            <td>Dott. <?php echo $str_docente?></td>
        </tr>
						<?php /*<tr style="background-color: #fff;">
							<td width="50%" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" style="font:normal 13px/15px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
								 <img src="<?php echo $foto?>" alt="product" style="width:100%">
							</td>
							<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" style="font:normal 13px/15px Arial, Helvetica, sans-serif; color:#888; padding:15px 8px;">
								<p>
								   <h4 class="product-title">
										<a href="<?php echo $url?>"><?php echo $inf_item['sotto_titolo']?></a>
									</h4>
									<br>
									<?php echo $str_docente?>
									<br/>
									<?php echo $str_date;
									/*if($inf_corsi['tipologia_corsi']=='online') echo lang('front.field_de')." 00/00/0000 ".lang('front.field_a')."  00/00/0000";
									else{
										
										echo lang('front.field_de')." ".$firstdate." ".lang('front.field_a')." ".$lastdate;
									}*/?>
							<?php /*		
								</p>
							</td>
						</tr> */?>
		 <?php } } ?>
		  </tbody>
</table>
<?php
			$cart_items=ob_get_clean();
			$cart_url=base_url('user/cart');
			$html=str_replace(array("{var_name}","{var_email}","{var_date}","{var_total_ht}","{var_discount_row}","{var_total_tax}","{var_total}","{var_payment_status}","{var_coupon}","{var_invoice_data}","{var_cart_details}","{var_payment_details}","{cart_url}"),
			array($inf_participant['display_name'],$inf_participant['email'],date('d/m/Y',strtotime($inf_cart['date'])),number_format($inf_cart['total_ht'],2,',','.'),$discount_row,number_format($inf_cart['total_vat'],2,',','.'),number_format($inf_cart['total_vat']+$inf_cart['total_ht'],2,',','.'),$payment_status,$coupon,$invoice_data,$cart_items,$payment_details,$cart_url ),
			$temp[0]['html']);
			
			$email = \Config\Services::email();
			$sender_name=$settings['sender_name'];
			$sender_email=$settings['sender_email'];
				$inf_ente=$this->UserModel->find($common_data['selected_ente']['id']);
			
			$SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'] ?? "";
				if($SMTP!="") $vals=json_decode($SMTP,true);
			
				if(!empty($vals)){
					if(isset($vals['sender_name'])  && $vals['sender_name']!="") $sender_name=$vals['sender_name']; else $sender_name=$settings['sender_name'];
					if(isset($vals['sender_email']) && $vals['sender_email']!="") $sender_email=$vals['sender_email']; else $sender_email=$settings['sender_email'];
					
					$email->SMTPHost=$vals['host'];
					$email->SMTPUser=$vals['username'];
					$email->SMTPPass=$vals['password'];
					$email->SMTPPort=$vals['port'];
				}
		
			
				$email->setFrom($sender_email,$sender_name);
				
			$email->setTo($inf_participant['email']);
			$email->setCc($inf_ente[0]['email']);
			$email->setSubject($temp[0]['subject']);
			$email->setMessage($html);
			$email->setAltMessage(strip_tags($html));
			
			$xxx=$email->send();
			$yy=$this->NotifLogModel->insert(array('id_participant'=>$inf_participant['id'],'type'=>'email','user_to'=>$inf_participant['email'],'subject'=>$temp[0]['subject'],'message'=>$html,'date'=>date('Y-m-d H:i:s')));
		
			
			
		}
	}
}