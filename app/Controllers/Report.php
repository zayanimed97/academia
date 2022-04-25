<?php namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Report extends BaseController
{
	public function index()
	{ 	
	
	}
	
	public function list_participanti(){
		$common_data=$this->common_data();
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$list_participant=$this->UserModel->where('role','participant')->where('id_ente',$common_data['user_data']['id'])->find();
		$l=array();
		if(!empty($list_participant)){
			

			foreach($list_participant as $k=>$v){
					
					
					$inf_user_profile=$this->UserProfileModel->where('user_id',$v['id'])->first();
					$l[$k]['cognome']=$inf_user_profile['cognome'];
					$l[$k]['nome']=$inf_user_profile['nome'];		
					$l[$k]['phone']=$inf_user_profile['mobile'];		
					$l[$k]['email']=$inf_user_profile['email'];	
					$l[$k]['cf']=$inf_user_profile['cf'];
					$l[$k]['adr']=$inf_user_profile['residenza_indirizzo'];
					if($inf_user_profile['residenza_stato']=='106'){
						$inf_provincia=$this->ProvinceModel->find($inf_user_profile['residenza_provincia']);
						$inf_comune=$this->ComuniModel->find($inf_user_profile['residenza_comune']);
						if(!empty($inf_provincia)) $residenza_provincia=$inf_provincia['provincia'] ?? '';
						if(!empty($inf_comune)) $residenza_comune=$inf_comune['comune'] ?? '';
					}
					else{
						$residenza_provincia=$inf_user_profile['residenza_provincia'];
						$residenza_comune=$inf_user_profile['residenza_comune'];
					}
					//var_dump($inf_user_profile['residenza_comune']);
					$l[$k]['city']=$residenza_comune ?? '';
					$l[$k]['cap']=$inf_user_profile['residenza_cap'];
					$l[$k]['provincia']=$residenza_provincia ?? '';
					$l[$k]['nascita_luogo']=$inf_user_profile['nascita_provincia'];//$residenza_provincia;
					$l[$k]['nascita_data']=$inf_user_profile['nascita_data'];
			}
			
			$sheet->mergeCells("A1:Z1");
			$sheet->setCellValue('A1', "Lista participanti");
			$sheet->mergeCells("A2:Z2");
			$sheet->setCellValue('A2', '');
			
			$j=1;
			$i=3;
			$sheet->setCellValueByColumnAndRow($j++,$i, 'cognome');
			$sheet->setCellValueByColumnAndRow($j++,$i, 'nome');
			$sheet->setCellValueByColumnAndRow($j++,$i, 'Telefono');
			$sheet->setCellValueByColumnAndRow($j++,$i, 'Email');
			
			
			$sheet->setCellValueByColumnAndRow($j++,$i, 'Codice fiscale');
			$sheet->setCellValueByColumnAndRow($j++,$i, 'Indirizzo');
			$sheet->setCellValueByColumnAndRow($j++,$i, 'Città');
			$sheet->setCellValueByColumnAndRow($j++,$i, 'Cap');
			$sheet->setCellValueByColumnAndRow($j++,$i, 'Provincia');
			
			$sheet->setCellValueByColumnAndRow($j++,$i, 'luogi di nascita');
			$sheet->setCellValueByColumnAndRow($j++,$i, 'data di nascita');
			for($i=0;$i<count($l);$i++)
			{

			//set value for indi cell
			$row=$l[$i];

			//writing cell index start at 1 not 0
			$j=1;

				foreach($row as $x => $x_value) {
					$sheet->setCellValueByColumnAndRow($j,$i+4,$x_value);
					$j=$j+1;
				}

			}
			$writer = new Xlsx($spreadsheet);
			$name='list_participazione_'.time().".xlsx";
			$writer->save(ROOTPATH.'/public/uploads/report/'.$name);
			return redirect()->to(base_url('uploads/report/'.$name));
		}
			
		
	}
}
?>