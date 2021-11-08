<?php
namespace App\Controllers;
use App\Models\SettingModel;
use App\Models\TemplatesModel;
use App\Models\ComuniModel;
use App\Models\NazioniModel;
use App\Models\ProvinceModel;
use App\Models\UserModel;
use App\Models\UserProfileModel;

use App\Models\BookingModel;
use App\Models\BookingNoteModel;
use App\Models\ItemsModel;
use App\Models\ItemsCategoryModel;
use App\Models\NotifLogModel;
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
	protected $helpers = ['form','url','text'];

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
		$email = \Config\Services::email();
		$email->SMTPHost="google.com";
	
		// $this->SettingModel =  new SettingModel();
		// $this->TemplatesModel =  new TemplatesModel();
		// $this->ComuniModel =  new ComuniModel();
		// $this->NazioniModel =  new NazioniModel();
		// $this->ProvinceModel =  new ProvinceModel();
		// $this->NotifLogModel= new NotifLogModel();
		// $this->UserModel =  new UserModel();
		// $this->UserProfileModel =  new UserProfileModel();
		
		// $this->BookingModel =  new BookingModel();
		// $this->BookingNoteModel =  new BookingNoteModel();
		// $this->ItemsModel =  new ItemsModel();
		// $this->ItemsCategoryModel =  new ItemsCategoryModel();
		$this->ItemType=array(1=>'Auto',2=>'Instrumenti');
		$this->AutoCarburant=array('Diesel','Essence','GPL','Metano');
		$this->BookingStatus=array( 1=>array('label'=>'in sospeso','bg'=>'bg-warning'),
									2=>array('label'=>'accettato','bg'=>'bg-success'),
									3=>array('label'=>'rifiutato','bg'=>'bg-danger'),
								);
		$this->BookingPriority=array(1=>'basso',2=>'medio',3=>'alto');
	}
	
	public function common_data(){
		$common_data=array();
		$is_logged=false;
		$user_data=$this->session->get('user_data');	
		if(!empty($user_data)) $is_logged=true;
		$common_data['is_logged']=$is_logged;
		$common_data['user_data']=$user_data;
		$settings=$this->SettingModel->getByMetaKey();
		$common_data['settings']=$settings;
		$common_data['ItemType']=$this->ItemType;
		$common_data['AutoCarburant']=$this->AutoCarburant;
		$common_data['BookingStatus']=$this->BookingStatus;
		$common_data['BookingPriority']=$this->BookingPriority;
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
