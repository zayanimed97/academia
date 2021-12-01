<?php namespace App\Controllers;

class CategoriesController extends BaseController
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
		$categories = $this->CategorieModel->where('id_ente', $user_data['id'])->find();
		$data['categories'] = $categories;
		if(null!==$this->session->get('success')){
			$data['success']=$this->session->get('success');
			$this->session->remove('success');
		}
		return view('admin/categories.php',$data);
	}

	public function new()
	{
		if($this->request->getVar('enable')!==null) $status='enable'; else $status='disable';
		$this->CategorieModel->insert	([
											'titolo' => $this->request->getVar('name'),
											'status' => $status,
											'url' => url_title($this->request->getVar('name')),
											'id_ente'=> $this->session->get('user_data')['id']
										]);
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_add'));
	}

	public function update()
	{if($this->request->getVar('enable')!==null) $status='enable'; else $status='disable';
		$this->CategorieModel->where('id_ente', $this->session->get('user_data')['id'])->update	($this->request->getVar('catId'),[
											'titolo' => $this->request->getVar('name'),
											'status' => $status,
											'url' => url_title($this->request->getVar('name')),
										]);
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_update'));
	}
	
	public function delete($id)
	{
		$this->CategorieModel->where('id_ente', $this->session->get('user_data')['id'])->where('id', $id)->delete();
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_delete'));
	}
}
?>
