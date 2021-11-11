<?php namespace App\Controllers;

class DisciplineController extends BaseController
{

	
	public function show($id_professione)
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$settings=$this->SettingModel->getByMetaKey();
		$discipline = $this->DisciplineModel->join('professione p', 'p.idprof = discipline.idprofessione')->where('id_ente', $user_data['id'])->where('idprofessione', $id_professione)->select('discipline.*')->find();
		return view('admin/discipline.php',array('settings'=>$settings, 'discipline'=>$discipline, 'id_professione' => $id_professione));
	}

	public function new()
	{
		$arg = $this->ProfessioneModel->where('idprof', $this->request->getVar('id_professione'))->first();
		if ($arg['id_ente'] == $this->session->get('user_data')['id']) {
			$this->DisciplineModel->insert	([
				'disciplina' => $this->request->getVar('name'),
				'codice_disciplina' => $this->request->getVar('codice'),
				'idprofessione'=> $this->request->getVar('id_professione')
			]);
		}
		
		return redirect()->to($_SERVER['HTTP_REFERER']);
		}

	public function update()
	{
		$arg = $this->DisciplineModel->join('professione p', 'discipline.idprofessione = p.idprof')->where('discipline.iddisciplina', $this->request->getVar('catId'))->select('p.id_ente')->first();
		if ($arg['id_ente'] == $this->session->get('user_data')['id']) {
		$this	->DisciplineModel
				// ->join('professione p', 'p.idprof = discipline.idprofessione')
				// ->where('p.id_ente', $this->session->get('user_data')['id'])

				
				->update($this->request->getVar('catId'),	[
																'disciplina' => $this->request->getVar('name'),
																'codice_disciplina' => $this->request->getVar('codice'),
															]);
		}
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
	
	public function delete($id)
	{
		$arg = $this->DisciplineModel->join('professione p', 'discipline.idprofessione = p.idprof')->where('discipline.iddisciplina', $id)->select('p.id_ente')->first();
		if ($arg['id_ente'] == $this->session->get('user_data')['id']) {
		$this	->DisciplineModel
				// ->join('professione p', 'p.idprof = discipline.idprofessione')
				// ->where('id_ente', $this->session->get('user_data')['id'])
				->where('iddisciplina', $id)->delete();
		}
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
?>
