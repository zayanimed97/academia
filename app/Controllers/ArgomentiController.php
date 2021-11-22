<?php namespace App\Controllers;

class ArgomentiController extends BaseController
{
	
	public function show()
	{ 	
		$common_data=$this->common_data();
		$data=$common_data;

		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$argomenti = $this->ArgomentiModel->where('id_ente', $user_data['id'])->find();
		$data['argomenti'] = $argomenti;

		return view('admin/argomenti.php',$data);
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
