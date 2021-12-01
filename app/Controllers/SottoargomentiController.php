<?php namespace App\Controllers;

class SottoargomentiController extends BaseController
{

	
	public function show($id_argumenti)
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$common_data=$this->common_data();
		$data=$common_data;

		$sottoargomenti = $this->SottoargomentiModel->join('argomenti a', 'a.idargomenti = sottoargomenti.id_argomenti')->where('id_ente', $user_data['id'])->where('id_argomenti', $id_argumenti)->select('sottoargomenti.*,a.nomeargomento')->find();
		$data['sottoargomenti'] = $sottoargomenti;
		$data['id_argomenti'] = $id_argumenti;
		$data['inf_argo']=$this->ArgomentiModel->find($id_argumenti);
		if(null!==$this->session->get('success')){
			$data['success']=$this->session->get('success');
			$this->session->remove('success');
		}
		return view('admin/sottoargomenti.php',$data);
	}

	public function new()
	{
		$arg = $this->ArgomentiModel->where('idargomenti', $this->request->getVar('id_argomenti'))->first();
		if ($arg['id_ente'] == $this->session->get('user_data')['id']) {
			$this->SottoargomentiModel->insert	([
				'titolo' => $this->request->getVar('name'),
				'url' => url_title($this->request->getVar('name')),
				'id_argomenti'=> $this->request->getVar('id_argomenti')
			]);
		}
		
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_add'));
		}

	public function update()
	{
		$arg = $this->SottoargomentiModel->join('argomenti a', 'sottoargomenti.id_argomenti = a.idargomenti')->where('sottoargomenti.id', $this->request->getVar('catId'))->select('a.id_ente')->first();
		if ($arg['id_ente'] == $this->session->get('user_data')['id']) {
		$this	->SottoargomentiModel
				// ->join('argomenti a', 'a.idargomenti = sottoargomenti.id_argomenti')
				// ->where('a.id_ente', $this->session->get('user_data')['id'])

				
				->update($this->request->getVar('catId'),	[
																'titolo' => $this->request->getVar('name'),
																'url' => url_title($this->request->getVar('name')),
															]);
		}
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_update'));
	}
	
	public function delete($id)
	{
		$arg = $this->SottoargomentiModel->join('argomenti a', 'sottoargomenti.id_argomenti = a.idargomenti')->where('sottoargomenti.id', $id)->select('a.id_ente')->first();
		if ($arg['id_ente'] == $this->session->get('user_data')['id']) {
		$this	->SottoargomentiModel
				// ->join('argomenti a', 'a.idargomenti = sottoargomenti.id_argomenti')
				// ->where('id_ente', $this->session->get('user_data')['id'])
				->where('id', $id)->delete();
		}
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_delete'));
	}
}
?>
