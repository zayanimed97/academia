<?php namespace App\Controllers;

class PdfLibController extends BaseController
{

	// public function __construct()
	// {
	// 	$this->session = \Config\Services::session();
	// 	session()->start();
	// 	return redirect('/login', 'refresh');
	// 	$user_data=$this->session->get('user_data');
	// 	die(var_dump(($user_data['role'] ?? '') != 'user') );
	// 	if(($user_data['role'] ?? '') != 'user') return redirect()->to( base_url('/login') );
	// }
	
	public function show()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$categories = $this->CorsiPDFLibModel->where('id_ente', $user_data['id'])->where('banned','no')->find();
		$data['categories'] = $categories;
		if(null!==$this->session->get('success')){
			$data['success']=$this->session->get('success');
			$this->session->remove('success');
		}
		return view('admin/pdf_lib.php',$data);
	}

	public function new()
	{
		
		$common_data=$this->common_data();
	if(!is_null($this->request->getVar('status'))) $enable="yes"; else $enable="no";
	if(!is_null($this->request->getVar('featured'))) $featured="yes"; else $featured="no";
		 $validated = $this->validate([
		 'pdfname' => ['label' => lang('app.field_doc_title'), 'rules' => 'trim|required'],
			'filename' => [
				'uploaded[filename]',
				'mime_in[filename,application/pdf,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[filename,4096]',
			],
		]);
		
		if ($validated) { 
			$avatar_logo = $this->request->getFile('filename');
			 $logo_name = $avatar_logo->getRandomName();
			
			$avatar_logo->move(ROOTPATH.'public/uploads/corsiPDF/',$logo_name);
			$data=array(
			'id_ente'=>$common_data['user_data']['id'],
				'pdfname'=>$this->request->getVar('pdfname'),
				'filename'=>$logo_name,
				'enable'=>$enable,
				'featured'=>$featured,
				'accesso'=>$this->request->getVar('accesso'),
				'created_at'=>date('Y-m-d H:i:s'),
				
			);
			$pdf_id=$this->CorsiPDFLibModel->insert($data);
			return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_add'));
		}
		else 
		
			return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', lang('app.error_required'));
	}

	public function update()
	{$common_data=$this->common_data();
	if(!is_null($this->request->getVar('status'))) $enable="yes"; else $enable="no";
	if(!is_null($this->request->getVar('featured'))) $featured="yes"; else $featured="no";
	$id=$this->request->getVar('catId');
	$data=array(
			'id_ente'=>$common_data['user_data']['id'],
				'pdfname'=>$this->request->getVar('pdfname'),
			
				'enable'=>$enable,
				'featured'=>$featured,
				'accesso'=>$this->request->getVar('accesso'),
				
			);
	
	
		 $validated = $this->validate([
		 'pdfname' => ['label' => lang('app.field_doc_title'), 'rules' => 'trim|required'],
			'filename' => [
				'uploaded[filename]',
				'mime_in[filename,application/pdf,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[filename,4096]',
			],
		]);
		
		if ($validated) { 
			$avatar_logo = $this->request->getFile('filename');
			 $logo_name = $avatar_logo->getRandomName();
			
			$avatar_logo->move(ROOTPATH.'public/uploads/corsiPDF/',$logo_name);
			$data['filename']=$logo_name ;
		}	
			$this->CorsiPDFLibModel->update($id,$data);
			return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_update'));
		
		
		
	}
	
	public function delete($id)
	{  
		$this->CorsiPDFLibModel->update($id,array('banned'=>'yes'));
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_delete'));
	}
}
?>
