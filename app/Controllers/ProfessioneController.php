<?php namespace App\Controllers;

class ProfessioneController extends BaseController
{
	
	public function show()
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$common_data=$this->common_data();
		$data=$common_data;

		$professione = $this->ProfessioneModel->where('id_ente', $user_data['id'])->find();
		$data['professione'] = $professione;
		return view('admin/professione.php',$data);
	}

	public function new()
	{if($this->request->getVar('enable')!==null) $status='enable'; else $status='disable';
		$this->ProfessioneModel->insert	([
											'professione' => $this->request->getVar('name'),
											'codice' => $this->request->getVar('codice'),
											'status' => $status,
											'id_ente'=> $this->session->get('user_data')['id']
										]);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}

	public function update()
	{if($this->request->getVar('enable')!==null) $status='enable'; else $status='disable';
		$this->ProfessioneModel->where('id_ente', $this->session->get('user_data')['id'])->update	($this->request->getVar('catId'),[
											'professione' => $this->request->getVar('name'),
											'codice' => $this->request->getVar('codice'),
											'status' => $status,
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
