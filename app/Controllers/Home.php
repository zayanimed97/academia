<?php
namespace App\Controllers;
use App\Libraries\Fattureincloud;
class Home extends BaseController
{
    public function index()
    {
      
        $data = $this->common_data();
		$inf_page=$this->PagesModel->where('url','home')->where('id_ente',$data['selected_ente']['id'])->first();
		$data['seo_title']=$inf_page['seo_title'];
		$data['seo_description']=$inf_page['seo_description'];
		$data['text']=$inf_page['text'];
		if($inf_page['image']!=""){ $seo_image=base_url('uploads/pages/'.$inf_page['image']);
		$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/pages/'.$inf_page['image'])
										->getFile()
										->getProperties(true);
			$data['seo_image_info']=$info;
		}
		else $seo_image="";
		$data['seo_image']=$seo_image;
		
		
		
        return view($data['view_folder'].'/home', $data);
    }

	public function page($url)
    {
    
        $data = $this->common_data();
		$inf_page=$this->PagesModel->where('url',$url)->where('type','dynamic')->where('banned','no')->where('enable','yes')->where('id_ente',$data['selected_ente']['id'])->first();
		if(empty($inf_page)){
			return redirect()->to(base_url());
		}
		$data['inf_page']=$inf_page;
		$data['seo_title']=$inf_page['seo_title'];
		$data['seo_description']=$inf_page['seo_description'];
		if($inf_page['image']!=""){ $seo_image=base_url('uploads/pages/'.$inf_page['image']);
		$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/pages/'.$inf_page['image'])
										->getFile()
										->getProperties(true);
			$data['seo_image_info']=$info;
		}
		else $seo_image="";
		$data['seo_image']=$seo_image;
        return view($data['view_folder'].'/page', $data);
    }

    public function pagece()
    {
    
        $data = $this->common_data();

        return view('default/page-ce-1', $data);
    }
	
	public function contact_page(){
		$data = $this->common_data();
		$common_data=$data;
		$inf_page=$this->PagesModel->where('url','contact')->where('id_ente',$data['selected_ente']['id'])->first();
		if(empty($inf_page)){
			return redirect()->to(base_url());
		}
		if($this->request->getVar('submit')!==null){
			$email = \Config\Services::email();
					$subscribe_email=$common_data['selected_ente']['email'] ?? '';
					$inf_profile=$this->UserProfileModel->where('user_id',$common_data['selected_ente']['id'])->first();
					if($inf_profile['email']!="" && $subscribe_email=="") $subscribe_email=$inf_profile['email'];
					$sender_name=$this->request->getVar('nome').' '.$this->request->getVar('cognome');
					$sender_email=$this->request->getVar('email');
					
					if(!empty($common_data['selected_ente']) && isset($common_data['selected_ente'])){
						
					
					/*	 $SMTP=$this->SettingModel->getByMetaKeyEnte($common_data['selected_ente']['id'],'SMTP')['SMTP'];
						if($SMTP!="") $vals=json_decode($SMTP,true);
					
						if(!empty($vals)){
							if(isset($vals['sender_name'])) $sender_name=$vals['sender_name'];
							if(isset($vals['sender_email'])) $sender_email=$vals['sender_email'];
							$email->protocol='smtp';
							$email->SMTPHost=$vals['host'];
							$email->SMTPUser=$vals['username'];
							$email->SMTPPass=$vals['password'];
							$email->SMTPPort=$vals['port'];
						}*/
						
					}
					$email->setFrom($sender_email,$sender_name);
					
					$email->setTo($subscribe_email);
				
				 
					
					
					$email->setSubject($this->request->getVar('subject').' - Contatti Form');
					$html=nl2br($this->request->getVar('message'))."<hr><br/>".$this->request->getVar('nome').' '.$this->request->getVar('cognome').'<br/>'.$this->request->getVar('email').'<br/>'.$this->request->getVar('phone');
					$email->setMessage($html);
					$email->setAltMessage(strip_tags($html));
					
					$xxx=$email->send();
					$data['success']=lang('front.msg_success_send_contact_form');
		}
		$data['inf_page']=$inf_page;
		$data['seo_title']=$inf_page['seo_title'];
		$data['seo_description']=$inf_page['seo_description'];
		if($inf_page['image']!=""){ $seo_image=base_url('uploads/pages/'.$inf_page['image']);
		$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/pages/'.$inf_page['image'])
										->getFile()
										->getProperties(true);
			$data['seo_image_info']=$info;
		}
		else $seo_image="";
		$data['seo_image']=$seo_image;
        return view($data['view_folder'].'/contact', $data);
	}
    public function getCourses()
    {
        $data = $this->common_data();

        $courses = $this->CorsiModel->where("find_in_set( '".($this->request->getVar('category') ?? '')."', id_categorie) > 0")
                                    ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0')
                                    ->where('corsi.banned', 'no')
                                    ->where('corsi.status', 'si')
                                    ->groupBy('corsi.id')
                                    ->join('corsi_prezzo_prof prezz', 'prezz.id_corsi = corsi.id', 'left')
                                    ->where('corsi.id_ente', $data['selected_ente']['id'])
                                    ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id AND cm.banned = "no" AND cm.status = "si"', 'left')
                                    ->groupBy('corsi.id')->having('count(cm.id) > 0')
                                    ->select("  corsi.video_promo, 
                                                corsi.foto, 
                                                corsi.url, 
                                                corsi.sotto_titolo, 
                                                corsi.tipologia_corsi, 
                                                corsi.prezzo, 
                                                corsi.id, 
                                                corsi.buy_type, 
                                                corsi.obiettivi, 
                                                corsi.have_def_price, 
                                                corsi.free, 
                                                corsi.duration, 
                                                MAX(prezz.prezzo) as max_price, 
                                                MIN(prezz.prezzo) as min_price, 
                                                GROUP_CONCAT(DISTINCT u.display_name) doctor_names, 
                                                count(DISTINCT cm.id) as modulo_count,
                                                corsi.ids_professione
                                            ")
                                    ->find();
        $idsCorsi = array_map(function ($el){return $el['id'];}, $courses);
        $discountsCorsi = $this->CorsiPrezzoProfModel->whereIn('id_corsi', $idsCorsi)->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();
        foreach ($courses as $key => &$course) {
            // get profs for this course
            $this->discounts($course, $discountsCorsi ?? []);
        }
        echo json_encode($courses);
    }

    public function getProv()
    {
        $country = $this->request->getVar('country');
        
        if ($country == '106') {
            $provs = $this->ProvinceModel->orderBy('provincia','ASC')->find();
            if (($this->request->getVar('name') ?? '') == "fattura_provincia") {
                $fieldName = 'fattura_comuni';
                $selectName = 'fattura_comune';
            } else {
                $fieldName = 'comuni';
                $selectName = 'residenza_comune';
            }

            $html = '<select name="'.$this->request->getVar('name').'" class="form-control selectpicker border rounded-md"';
            if (!(($this->request->getVar('name') ?? '') == "nascita_provincia")) {
                $html .= '@change="fetch(`'.base_url().'/getComm?prov=${$event.target.value}&name='.$selectName.'`, {method: &quot;get&quot;,  headers: {&quot;Content-Type&quot;: &quot;application/json&quot;, &quot;X-Requested-With&quot;: &quot;XMLHttpRequest&quot; }}).then( el => el.text() ).then(res => {'.$fieldName.' = res; if(jQuery().selectpicker){setTimeout(() => {$(&quot;select&quot;).selectpicker(&quot;render&quot;)}, 50);}})"';
            }
            $html .= '><option value="0"> Select Provincia </option>';
            foreach ($provs as $prov) {
                $html .= '<option ';
                if ($this->request->getVar('selected') == $prov['id']) {
                    $html .= 'selected value="'.$prov['id'].'">'.$prov['provincia'].'</option>';
                } else {
                    $html .= 'value="'.$prov['id'].'">'.$prov['provincia'].'</option>';
                }
            }
            $html .= '</select>';
        }
        else {
            $html = '<input type="text" id="'.$this->request->getVar('name').'" name="'.$this->request->getVar('name').'" class="form-control with-border" value="">';
        }

        echo $html;
    }

    public function getComm()
    {
        $prov = $this->request->getVar('prov');

            $comuni = $this->ComuniModel->where('id_prov', $prov)->orderBy('comune','ASC')->find();

            $html = '<select name="'.$this->request->getVar('name').'" class="form-control selectpicker border rounded-md" ><option value="0"> Select Comune </option>';
            foreach ($comuni as $com) {
                $html .= '<option ';
                if ($this->request->getVar('selected') == $com['id']) {
                    $html .= 'selected value="'.$com['id'].'">'.$com['comune'].'</option>';
                } else {
                    $html .= 'value="'.$com['id'].'">'.$com['comune'].'</option>';
                }
            }
            $html .= '</select>';
        echo $html;
    }
    public function getServerName()
    {
        echo $_SERVER['SERVER_NAME'];
    }

    public function getBlog()
    {
        $data = $this->common_data();

        return view($data['view_folder'].'/blog', $data);
    }
	
	
	public function getInvoiceFattureCloud($id){
		$common_data=$this->common_data();
		$fattura_incloud=json_decode($common_data['settings']['fattura_incloud'],true);
		$Fattureincloud=new Fattureincloud($fattura_incloud['id'] ?? '',$fattura_incloud['key'] ?? '');
		$pdf=$Fattureincloud->getPdf($id);
		return redirect()->to($pdf);
	}
	
	public function confirm_participation_by_mail($id_p,$id_user){
		$common_data=$this->common_data();
		$data=$common_data;
		$data['seo_title']=lang('front.title_page_thanks');
		$data['seo_description']="";
		$data['text']=lang('front.title_page_thanks');
		$inf_p=$this->ParticipationModel->where('id',$id_p)->where('id_user',$id_user)->first();
		if(!empty($inf_p)){
			$this->ParticipationModel->update($id_p,array('confirm_mail'=>date('Y-m-d H:i:s')));
		}
		
		return view($data['view_folder'].'/thankyou_confirm_participation.php',$data);
	}
}
