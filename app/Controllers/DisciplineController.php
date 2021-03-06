<?php namespace App\Controllers;

class DisciplineController extends BaseController
{

	
	public function show($id_professione)
	{ 	
		$user_data=$this->session->get('user_data');
		// die(var_dump($user_data));
		$common_data=$this->common_data();
		$data=$common_data;
		$discipline = $this->DisciplineModel->join('professione p', 'p.idprof = discipline.idprofessione')->where('id_ente', $user_data['id'])->where('idprofessione', $id_professione)->select('discipline.*')->find();
		$data['discipline'] = $discipline;
		$data['id_professione'] = $id_professione;
		$data['inf_argomento']=$this->ProfessioneModel->find($id_professione);
		if(null!==$this->session->get('success')){
			$data['success']=$this->session->get('success');
			$this->session->remove('success');
		}
		return view('admin/discipline.php',$data);
	}

	public function new()
	{if($this->request->getVar('enable')!==null) $status='enable'; else $status='disable';
		$arg = $this->ProfessioneModel->where('idprof', $this->request->getVar('id_professione'))->first();
		if ($arg['id_ente'] == $this->session->get('user_data')['id']) {
			$this->DisciplineModel->insert	([
				'disciplina' => $this->request->getVar('name'),
				'codice_disciplina' => $this->request->getVar('codice'),
				'status' => $status,
				'idprofessione'=> $this->request->getVar('id_professione')
			]);
		}
		
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_add'));
		}

	public function update()
	{if($this->request->getVar('enable')!==null) $status='enable'; else $status='disable';
		$arg = $this->DisciplineModel->join('professione p', 'discipline.idprofessione = p.idprof')->where('discipline.iddisciplina', $this->request->getVar('catId'))->select('p.id_ente')->first();
		if ($arg['id_ente'] == $this->session->get('user_data')['id']) {
		$this	->DisciplineModel
				// ->join('professione p', 'p.idprof = discipline.idprofessione')
				// ->where('p.id_ente', $this->session->get('user_data')['id'])

				
				->update($this->request->getVar('catId'),	[
																'disciplina' => $this->request->getVar('name'),
																'codice_disciplina' => $this->request->getVar('codice'),
																'status' => $status,
															]);
		}
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_update'));
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
		return redirect()->to($_SERVER['HTTP_REFERER'])->with('success', lang('app.success_delete'));
	}
}
?>
