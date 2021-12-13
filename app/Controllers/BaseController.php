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
use App\Models\CartItemsModel;
use App\Models\CartPaymentModel;
use App\Models\ParticipationModel;
use App\Models\PagesModel;
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

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form','url','text','language','session'];

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
		$this->CartItemsModel=new CartItemsModel();
		$this->CartPaymentModel=new CartPaymentModel();
		$this->ParticipationModel=new ParticipationModel();
		$this->PagesModel=new PagesModel();
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
			$inf_package=$this->EntePackageModel->where('id_ente',$selected_ente['id'])->orderBy('expired_date','DESC')->first();
			$det=json_decode($inf_package['package'],true);
			$common_data['ente_package']=array("expired_date"=>$inf_package['expired_date'],"type_cours"=>$det['type_cours'],"extra"=>$det['extra']);
			$list_static_pages=$this->PagesModel->where('type','dynamic')->where('banned','no')->where('enable','yes')->where('id_ente',$selected_ente['id'])->orderBy('ord',"ASC")->find();
			$common_data['list_static_pages']=$list_static_pages;
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

		
		if(!is_null($this->session->get('login_as'))){
			$common_data['is_admin']=true;
			$common_data['redirect_admin']=base_url('superadmin/loginBack');//$this->session->get('redirect_admin');
		}

		$common_data['cart'] = $this->cart;
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
		$filter = array_filter($discount ?? [], function($el) use ($course) {return $el['id_corsi'] == $course['id'];});

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
            $course['prezzo'] = $course['free'] == 'yes' ? 'gratuito' : ((strpos($course['prezzo'], '€') || $course['prezzo'] == "") ? $course['prezzo'] : $this->amount->format($course['prezzo']));
	}
}
