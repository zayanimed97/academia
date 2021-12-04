<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class CorsiController extends BaseController
{
    public function index()
    {
        $data = $this->common_data();

        $data['sottoargomenti'] = $this->SottoargomentiModel->join('argomenti', 'id_argomenti = idargomenti')->groupBy('id')->where('id_ente', $data['selected_ente']['id'])->select('sottoargomenti.*, argomenti.url as nomeargomento')->find();

        $corsi = $this->CorsiModel->join('corsi_modulo cm', 'cm.id_corsi = corsi.id', 'left')->where('corsi.id_ente', $data['selected_ente']['id'])->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0')->select("corsi.*, GROUP_CONCAT(DISTINCT u.display_name) doctor_names, count(DISTINCT cm.id) as modulo_count")->groupBy('corsi.id');


        if ($this->request->getVar('categories')) {
            $corsi->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0')->whereIn('cat.url', explode(',',$this->request->getVar('categories')));
        }
        if ($this->request->getVar('argomenti')) {
            $corsi->join('argomenti arg', 'corsi.id_argomenti = arg.idargomenti')->whereIn('arg.url', explode(',',$this->request->getVar('argomenti')));
        }
        if ($this->request->getVar('sottoargomenti')) {
            $corsi->join('sottoargomenti sotto', 'corsi.sottoargomenti = sotto.id')->whereIn('sotto.url', explode(',',$this->request->getVar('sottoargomenti')));
        }
        if ($this->request->getVar('tipo')) {
            $corsi->whereIn('corsi.tipologia_corsi', explode(',',$this->request->getVar('tipo')));
        }
        $perPage = $this->request->getVar('perPage') ?? 12;
        $data['corsi'] = $corsi->paginate($perPage, 'corsi');
        $data['pagination'] = $corsi->pager->links('corsi','front_courses_pagination');

        // $db      = \Config\Database::connect();
        // echo '<pre>';
        // print_r($data['corsi']);
        // echo '</pre>';
        // exit;
        // // die(var_dump($data['category']));
        return view('default/courses', $data);
    }

    public function details($url)
    {
        $data = $this->common_data();

        $data['corsi'] = $this->CorsiModel  ->select('corsi.*')->where('corsi.id_ente', $data['selected_ente']['id'])
                                            ->where('corsi.url', $url)
                                            ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id', 'left')
                                            ->join('corsi_pdf_lib pdf', 'find_in_set(pdf.id, corsi.ids_pdf) > 0 AND pdf.accesso = "public"', 'left')
                                            ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0', 'left')
                                            ->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0', 'left')
                                            ->join('argomenti arg', 'arg.idargomenti = corsi.id_argomenti', 'left')
                                            ->select("corsi.*, SUM(cm.crediti) as ECM , pdf.filename as pdf, GROUP_CONCAT(DISTINCT u.display_name) doctor_names, GROUP_CONCAT(DISTINCT cat.titolo) categories, arg.nomeargomento")
                                            ->groupBy('corsi.id')
                                            ->first();
        $data['doctors'] = $this->UserModel->where("find_in_set(id, '{$data['corsi']['ids_doctors']}') > 0")->find();

        $data['module'] = $this->CorsiModuloModel->where('corsi_modulo.id_corsi', $data['corsi']['id'])->join('users u', 'u.id = instructor')->select('corsi_modulo.*, u.display_name')->find();

        // echo '<pre>';
        // print_r($data['doctors']);
        // echo '</pre>';
        // exit;

        return view('default/detaglio-corso', $data);
        
    }
}
