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
	protected $helpers = ['form','url','text','language'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{

		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$security = \Config\Services::security();
		$this->session = \Config\Services::session();
		$session = session()->start();
		
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
		
	
	}
	
	public function common_data(){
		$common_data=array();
		$is_logged=false;
		$user_data=$this->session->get('user_data');	
		if(!empty($user_data)) $is_logged=true;
		$common_data['is_logged']=$is_logged;
		$common_data['user_data']=$user_data;
		
		$selected_ente=$this->UserModel->where('role','ente')->where('domain_ente',$_SERVER['SERVER_NAME'] ?? 'localhost')->first();
		if(!empty($selected_ente)) $common_data['selected_ente']=$selected_ente['id'];
		
		$settings=$this->SettingModel->getByMetaKey();
		$common_data['settings']=$settings;
	
		$user_loginas=$this->session->get('user_loginas');	
		if(!empty($user_loginas)) $common_data['user_loginas']=$user_loginas;
		/* query to extract idEnte from server name 
		$_SERVER['SERVER_NAME']
		
		*/
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
}
