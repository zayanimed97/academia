<?php namespace App\Controllers;

class ObiettiviController extends BaseController
{
	
	public function show()
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$common_data=$this->common_data();
		$data=$common_data;

		$obiettivi = $this->ObiettiviFormazioneModel->where('id_ente', $user_data['id'])->find();
		$data['obiettivi'] = $obiettivi;
		return view('admin/obiettivi.php',$data);
	}

	public function new()
	{
		$this->ObiettiviFormazioneModel->insert	([
											'titolo' => $this->request->getVar('name'),
											'codice' => $this->request->getVar('codice'),
											'id_ente'=> $this->session->get('user_data')['id'],
											'url'=> url_title($this->request->getVar('name')),
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}

	public function update()
	{
		$this->ObiettiviFormazioneModel->where('id_ente', $this->session->get('user_data')['id'])->update	($this->request->getVar('catId'),[
											'titolo' => $this->request->getVar('name'),
											'codice' => $this->request->getVar('codice'),
											'url'=> url_title($this->request->getVar('name')),
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
	
	public function delete($id)
	{
		$this->ObiettiviFormazioneModel->where('id_ente', $this->session->get('user_data')['id'])->where('id', $id)->delete();
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
?>
