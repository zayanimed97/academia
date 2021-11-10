<?php namespace App\Controllers;

class ArgomentiController extends BaseController
{
	
	public function show()
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$settings=$this->SettingModel->getByMetaKey();
		$argomenti = $this->ArgomentiModel->where('id_ente', $user_data['id'])->find();
		return view('admin/argomenti.php',array('settings'=>$settings, 'argomenti'=>$argomenti));
	}

	public function new()
	{
		$this->ArgomentiModel->insert	([
											'nomeargomento' => $this->request->getVar('name'),
											'url' => url_title($this->request->getVar('name')),
											'id_ente'=> $this->session->get('user_data')['id']
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}

	public function update()
	{
		$this->ArgomentiModel->where('id_ente', $this->session->get('user_data')['id'])->update	($this->request->getVar('catId'),[
											'titolo' => $this->request->getVar('name'),
											'url' => url_title($this->request->getVar('name')),
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
	
	public function delete($id)
	{
		$this->ArgomentiModel->where('id_ente', $this->session->get('user_data')['id'])->where('idargomenti', $id)->delete();
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
?>
