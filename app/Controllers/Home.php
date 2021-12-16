<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
      
        $data = $this->common_data();
		$inf_page=$this->PagesModel->where('url','home')->where('id_ente',$data['selected_ente']['id'])->first();
		$data['seo_title']=$inf_page['seo_title'];
		$data['seo_description']=$inf_page['seo_description'];
		
		
		
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
        return view($data['view_folder'].'/page', $data);
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
					$subscribe_email=$common_data['selected_ente']['email'];
					$inf_profile=$this->UserProfileModel->where('user_id',$common_data['selected_ente']['id'])->first();
					if($inf_profile['email']!="") $subscribe_email=$inf_profile['email'];
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
        return view($data['view_folder'].'/contact', $data);
	}
    public function getCourses()
    {
        $courses = $this->CorsiModel->where('find_in_set( '.($this->request->getVar('category') ?? '').', id_categorie) > 0')
                                    ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0')
                                    ->where('banned', 'no')
                                    ->groupBy('corsi.id')
                                    ->select("corsi.*, GROUP_CONCAT(DISTINCT u.display_name) doctor_names")
                                    ->find();

        echo json_encode($courses);
    }

    public function getProv()
    {
        $country = $this->request->getVar('country');
        
        if ($country == '106') {
            $provs = $this->ProvinceModel->find();
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

            $comuni = $this->ComuniModel->where('id_prov', $prov)->find();

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
}
