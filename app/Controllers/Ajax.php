<?php

namespace App\Controllers;

class Ajax extends BaseController
{
    public function index()
    {
       
        return view('welcome_message');
    }
	
	public function get_provincia_by_nazione(){
		$id_nazione=$this->request->getVar('id_nazione');
		$t=$this->request->getVar('t');
		$tt=explode("_",$t);
		 $nn=$tt[0]."_provincia";
		$input = [
												
					'name'  => $nn,
					'id'    => $nn,
					'placeholder' =>lang('app.field_provincia'),
					'class' => 'form-control'
			];
		if($id_nazione==106){
			$list_provincia=$this->ProvinceModel->where('id_nazione',$id_nazione)->findAll();
			$options=array();
			$options['']=lang('app.field_select');
			foreach($list_provincia as $k=>$v){
				$options[$v['id']]=$v['provincia'];
			}
			$js = ' onChange="get_comune(\''.$nn.'\',this.value);"';
			echo form_dropdown($input, $options,'',$js);
		}
		else{
			
			echo form_input($input);
		}
		
		
	}
	
	public function get_comune_by_provincia(){
		 $id_provincia=$this->request->getVar('id_provincia');
		$t=$this->request->getVar('t');
		$tt=explode("_",$t);
		 $nn=$tt[0]."_comune";
		 
		$input = [
												
					'name'  => $nn,
					'id'    => $nn,
					'placeholder' =>lang('app.field_city'),
					'class' => 'form-control'
			];
		if(is_numeric($id_provincia)){
			$list_comune=$this->ComuniModel->where('id_prov',$id_provincia)->findAll();
			
			$options=array();
			$options['']=lang('app.field_select');
			foreach($list_comune as $k=>$v){
				$options[$v['id']]=$v['comune'];
			}
			
			echo form_dropdown($input, $options,'');
		}
		else{
			
			echo form_input($input);
		}
		
		
	}
}
