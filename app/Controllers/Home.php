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
        return view('default/home', $data);
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
        return view('default/page', $data);
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
                $html .= '@change="fetch(`'.base_url().'/getComm?prov=${$event.target.value}&name='.$selectName.'`, {method: &quot;get&quot;,  headers: {&quot;Content-Type&quot;: &quot;application/json&quot;, &quot;X-Requested-With&quot;: &quot;XMLHttpRequest&quot; }}).then( el => el.text() ).then(res => {'.$fieldName.' = res; if(jQuery().selectpicker){$(&quot;select&quot;).selectpicker();}})"';
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

        return view('default/blog', $data);
    }
}
