<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // $test = $this->SettingModel->where('meta_value','>',4)->first();
        
        $data = $this->common_data();

        
        $data['argomenti'] = $this->ArgomentiModel->where('c.id_ente', $data['selected_ente']['id'])->join('corsi c', 'c.id_argomenti = argomenti.idargomenti')->select('c.*, argomenti.*, argomenti.idargomenti as arg_id')->find();

        // $data['sottoargomenti'] = $this->SottoargomentiModel->where('c.id_ente', $data['selected_ente']['id'])->join('corsi c', 'c.sottoargomenti = sottoargomenti.id')->select('c.*, sottoargomenti.*, sottoargomenti.id as sotto_id')->find();

        // die(var_dump($data['sottoargomenti']));
        // echo '<pre>';
        // print_r($data['category']);
        // echo '</pre>';
        // exit;
        // die(var_dump($data['category']));
        return view('default/home', $data);
    }

    public function getCourses()
    {
        $courses = $this->CorsiModel->where('id_categorie', $this->request->getVar('category'))->find();

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

            $html = '<select name="'.$this->request->getVar('name').'" class="form-control"';
            if (!(($this->request->getVar('name') ?? '') == "nascita_provincia")) {
                $html .= '@change="fetch(`'.base_url().'/getComm?prov=${$event.target.value}&name='.$selectName.'`, {method: &quot;get&quot;,  headers: {&quot;Content-Type&quot;: &quot;application/json&quot;, &quot;X-Requested-With&quot;: &quot;XMLHttpRequest&quot; }}).then( el => el.text() ).then(res => '.$fieldName.' = res)"';
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
            $html = '<input type="text" id="'.$this->request->getVar('name').'" name="'.$this->request->getVar('name').'" class="form-control" value="">';
        }

        echo $html;
    }

    public function getComm()
    {
        $prov = $this->request->getVar('prov');

            $comuni = $this->ComuniModel->where('id_prov', $prov)->find();

            $html = '<select name="'.$this->request->getVar('name').'" class="form-control" ><option value="0"> Select Comune </option>';
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
}
