<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class CorsiController extends BaseController
{
    public function index()
    {
        $data = $this->common_data();

        $data['sottoargomenti'] = $this->SottoargomentiModel->join('argomenti', 'id_argomenti = idargomenti')->groupBy('id')->where('id_ente', $data['selected_ente']['id'])->select('sottoargomenti.*, argomenti.url as nomeargomento')->find();

        $corsi = $this->CorsiModel  ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id', 'left')
                                    ->join('argomenti arg', '((corsi.id_argomenti is null) OR (corsi.id_argomenti = "0") OR (arg.idargomenti = corsi.id_argomenti)) AND arg.banned = "no"')
                                    ->join('sottoargomenti sotto', '((corsi.sottoargomenti is null) OR (corsi.sottoargomenti = "0") OR (find_in_set(sotto.id, corsi.sottoargomenti) > 0)) AND sotto.banned = "no"')
                                    ->join('categorie cat', '((corsi.sottoargomenti is null) OR (corsi.sottoargomenti = "0") OR (find_in_set(cat.id, corsi.id_categorie) > 0)) AND cat.banned = "no" AND cat.status = "enable"')
                                    ->join('corsi_prezzo_prof prezz', 'prezz.id_corsi = corsi.id', 'left')
                                    ->where('corsi.id_ente', $data['selected_ente']['id'])
                                    ->where('corsi.banned', 'no')
                                    ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0')
                                    ->select("corsi.*, MAX(prezz.prezzo) as max_price, MIN(prezz.prezzo) as min_price, GROUP_CONCAT(DISTINCT u.display_name) doctor_names, count(DISTINCT cm.id) as modulo_count")
                                    ->groupBy('corsi.id');


        if ($this->request->getVar('categories')) {
            $corsi->where('corsi.id_categorie <> "0"')->where('corsi.id_categorie is not null')->whereIn('cat.url', explode(',',$this->request->getVar('categories')));
        }
        if ($this->request->getVar('argomenti')) {
            $corsi->where('corsi.id_argomenti <> "0"')->where('corsi.id_argomenti is not null')->whereIn('arg.url', explode(',',$this->request->getVar('argomenti')));
        }
        if ($this->request->getVar('sottoargomenti')) {
            $corsi->where('corsi.sottoargomenti <> "0"')->where('corsi.sottoargomenti is not null')->whereIn('sotto.url', explode(',',$this->request->getVar('sottoargomenti')));
        }
        if ($this->request->getVar('tipo')) {
            $corsi->whereIn('corsi.tipologia_corsi', explode(',',$this->request->getVar('tipo')));
        }
        $perPage = $this->request->getVar('perPage') ?? 12;
        $data['corsi'] = $corsi->paginate($perPage, 'corsi');
        $data['pagination'] = $corsi->pager->links('corsi','front_courses_pagination');


        // get prices by prof
        if((session('user_data')['role'] ?? '') == 'participant'){
            $ids = array_map(function ($el){return $el['id'];}, $data['corsi']);

            $discounts = $this->CorsiPrezzoProfModel->whereIn('id_corsi', $ids)->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();
        }


        foreach ($data['corsi'] as $key => &$course) {
            // get profs for this course
            $this->discounts($course, $discounts ?? []);
        }
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

        $joinLoggedIn = isset(session('user_data')['profile']['professione']) ? 'AND (prezz.id_professione = '.(session('user_data')['profile']['professione']).')' : '';
        $data['corsi'] = $this->CorsiModel  ->select('corsi.*')
                                            ->where('corsi.id_ente', $data['selected_ente']['id'])
                                            ->where('corsi.url', $url)
                                            ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id', 'left')
                                            ->join('corsi_pdf_lib pdf', 'find_in_set(pdf.id, corsi.ids_pdf) > 0 AND pdf.accesso = "public"', 'left')
                                            ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0', 'left')
                                            ->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0', 'left')
                                            ->join('argomenti arg', 'arg.idargomenti = corsi.id_argomenti', 'left')
                                            ->join('corsi_prezzo_prof prezz', '(prezz.id_corsi = corsi.id)'. $joinLoggedIn, 'left')
                                            ->select("corsi.*, MAX(prezz.prezzo) as max_price, MIN(prezz.prezzo) as min_price, SUM(cm.crediti) as ECM , pdf.filename as pdf, GROUP_CONCAT(DISTINCT u.display_name) doctor_names, GROUP_CONCAT(DISTINCT cat.titolo) categories, arg.nomeargomento")
                                            ->groupBy('corsi.id')
                                            ->first();
        $data['doctors'] = $this->UserModel->where("find_in_set(id, '{$data['corsi']['ids_doctors']}') > 0")->find();

        $data['module'] = $this->CorsiModuloModel->where('corsi_modulo.id_corsi', $data['corsi']['id'])->join('users u', 'u.id = instructor')->select('corsi_modulo.*, u.display_name')->find();

        if((session('user_data')['role'] ?? '') == 'participant'){
            $discounts = $this->CorsiPrezzoProfModel->where('id_corsi', $data['corsi']['id'])->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();
        }

        $this->discounts($data['corsi'], $discounts ?? []);
        // echo '<pre>';
        // print_r($data['corsi']);
        // echo '</pre>';
        // exit;

        return view('default/detaglio-corso', $data);
        
    }
}
