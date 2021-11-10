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
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$settings=$this->SettingModel->getByMetaKey();
		$categories = $this->CategorieModel->where('id_ente', $user_data['id'])->find();
		return view('admin/categories.php',array('settings'=>$settings, 'categories'=>$categories));
	}

	public function new()
	{
		$this->CategorieModel->insert	([
											'titolo' => $this->request->getVar('name'),
											'status' => 'enable',
											'url' => base_url().'/'.url_title($this->request->getVar('name')),
											'id_ente'=> $this->session->get('user_data')['id']
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}

	public function update()
	{
		$this->CategorieModel->where('id_ente', $this->session->get('user_data')['id'])->update	($this->request->getVar('catId'),[
											'titolo' => $this->request->getVar('name'),
											'url' => base_url().'/'.url_title($this->request->getVar('name')),
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
	
	public function delete($id)
	{
		$this->CategorieModel->where('id_ente', $this->session->get('user_data')['id'])->where('id', $id)->delete();
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
?>
