<?php namespace App\Controllers;

class ProfessioneController extends BaseController
{
	
	public function show()
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$settings=$this->SettingModel->getByMetaKey();
		$professione = $this->ProfessioneModel->where('id_ente', $user_data['id'])->find();
		return view('admin/professione.php',array('settings'=>$settings, 'professione'=>$professione));
	}

	public function new()
	{
		$this->ProfessioneModel->insert	([
											'professione' => $this->request->getVar('name'),
											'codice' => $this->request->getVar('codice'),
											'id_ente'=> $this->session->get('user_data')['id']
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}

	public function update()
	{
		$this->ProfessioneModel->where('id_ente', $this->session->get('user_data')['id'])->update	($this->request->getVar('catId'),[
											'professione' => $this->request->getVar('name'),
											'codice' => $this->request->getVar('codice'),
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
	
	public function delete($id)
	{
		$this->ProfessioneModel->where('id_ente', $this->session->get('user_data')['id'])->where('idprof', $id)->delete();
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
?>
