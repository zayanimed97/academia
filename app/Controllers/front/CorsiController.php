<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use KejawenLab\CodeIgniter\Pagination\Paginator;

class CorsiController extends BaseController
{
    public function index()
    {
        $db      = \Config\Database::connect();
        $data = $this->common_data();

        $data['sottoargomenti'] = $this->SottoargomentiModel->join('argomenti', 'id_argomenti = idargomenti')->groupBy('id')->where('id_ente', $data['selected_ente']['id'])->select('sottoargomenti.*, argomenti.url as nomeargomento')->find();

        $courses = function($for) use ($data) {
                        $corsi = $this  ->CorsiModel  
                                        ->join('argomenti arg', '((corsi.id_argomenti is null) OR (corsi.id_argomenti = "0") OR (arg.idargomenti = corsi.id_argomenti AND arg.banned = "no"))')
                                        ->join('sottoargomenti sotto', '((corsi.sottoargomenti is null) OR (corsi.sottoargomenti = "0") OR (find_in_set(sotto.id, corsi.sottoargomenti) > 0 AND sotto.banned = "no"))')
                                        ->join('categorie cat', '((corsi.id_categorie is null) OR (corsi.id_categorie = "0") OR (find_in_set(cat.id, corsi.id_categorie) > 0 AND cat.banned = "no" AND cat.status = "enable"))')
                                        ->join('corsi_prezzo_prof prezz', 'prezz.id_corsi = corsi.id', 'left')
                                        ->where('corsi.id_ente', $data['selected_ente']['id'])
                                        // ->where('corsi.buy_type', 'cours')
                                        ->where('corsi.banned', 'no')
                                        ->where('corsi.status', 'si')
                                        ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0')
                                        ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id AND cm.banned = "no" AND cm.status = "si"')
                                        ->join('corsi_modulo_date cmd', 'cmd.id_modulo = cm.id AND cmd.banned = "no"', 'left')
                                        ->groupBy('corsi.id')
                                        ->select($for == 'corsi' ? 
                                                "   corsi.video_promo, 
                                                    corsi.foto, 
                                                    corsi.url, 
                                                    corsi.sotto_titolo, 
                                                    corsi.tipologia_corsi, 
                                                    corsi.prezzo, 
                                                    corsi.id, 
                                                    corsi.buy_type, 
                                                    corsi.obiettivi, 
                                                    corsi.have_def_price, 
                                                    corsi.free, 
                                                    corsi.duration, 
                                                    corsi.difficulte, 
                                                    MAX(prezz.prezzo) as max_price, 
                                                    MIN(prezz.prezzo) as min_price, 
                                                    GROUP_CONCAT(DISTINCT u.display_name) doctor_names,
                                                    GROUP_CONCAT(DISTINCT cmd.id) dates,
                                                    count(DISTINCT cm.id) as modulo_count,
                                                    corsi.ids_professione,
                                                    '' as corsiSottoTitoloForModulo,
                                                    '' as corsi_id"
                                                : "corsi.id");

        if ($for == 'corsi') {
            $corsi->having('count(cm.id) > 0');
        }
        if ($for != 'corsi') {
            $corsi->having('count(DISTINCT cm.id) > 1');
        }
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
        // $data['corsi'] = $corsi->paginate($perPage, 'corsi');
        return $corsi->getCompiledSelect();};
        $moduloQuery = $this->CorsiModuloModel  ->select("  corsi_modulo.video_promo, 
                                                            corsi_modulo.foto, 
                                                            corsi_modulo.url, 
                                                            corsi_modulo.sotto_titolo, 
                                                            corsi.tipologia_corsi,
                                                            corsi_modulo.prezzo, 
                                                            corsi_modulo.id, 
                                                            corsi.buy_type as type,
                                                            corsi_modulo.obiettivi, 
                                                            corsi_modulo.have_def_price, 
                                                            corsi_modulo.free, 
                                                            corsi_modulo.duration,
                                                            corsi_modulo.difficulte,  
                                                            MAX(prezz.prezzo) as max_price, 
                                                            MIN(prezz.prezzo) as min_price,
                                                            u.display_name as doctor_names, 
                                                            GROUP_CONCAT(DISTINCT cmd.id) dates,
                                                            corsi.url as corsi_url,
                                                            corsi.ids_professione,
                                                            corsi.sotto_titolo,
                                                            corsi.id
                                                        ")
                                                ->join('corsi', "corsi.id = corsi_modulo.id_corsi AND corsi_modulo.id_corsi in ({$courses('modulo')}) AND corsi.buy_type <> 'cours'")
                                                ->join('users u', 'u.id = corsi_modulo.instructor', 'left')
                                                ->join('corsi_modulo_prezzo_prof prezz', 'corsi_modulo.id = prezz.id_modulo', 'left')
                                                ->join('corsi_modulo_date cmd', 'cmd.id_modulo = corsi_modulo.id AND cmd.banned = "no"', 'left')
                                                ->where('corsi_modulo.banned', 'no')
                                                ->where('corsi_modulo.status', 'si')
                                                ->groupBy('corsi_modulo.id')
                                                ->getCompiledSelect();


        $perPage = $this->request->getVar('perPage') ?? 12;

        // $corsi = $courses('corsi');
        $countRes = $db->query("SELECT count(*) as count FROM ({$courses('corsi')} UNION $moduloQuery) as a_table")->getRow()->count;
        $currentPage = $this->request->getVar('page') ?? 1;
        $offset = ($currentPage-1)*$perPage;
        $pagination['totalPages'] = ceil($countRes/$perPage);
        $pagination['isFirstPage'] = $offset == 0;
        $pagination['isLastPage'] = $offset > $countRes - $perPage ;
        $query = $_GET;

        // replace parameter(s)
        $query['page'] = $pagination['isFirstPage'] ? 1 : $currentPage - 1;
        // rebuild url
        $query_result = http_build_query($query);

        // create previous link
        $pagination['previous'] = $pagination['isFirstPage'] ? null : base_url('/corsi').'?'.$query_result;

        // replace parameter(s)
        $query['page'] = $pagination['isLastPage'] ? $pagination['totalPages'] : $currentPage + 1;
        // rebuild url
        $query_result = http_build_query($query);

        // create next link
        $pagination['next'] = $pagination['isLastPage'] ? null : base_url('/corsi').'?'.$query_result;

        // replace parameter(s)
        $query['page'] = 1;
        // rebuild url
        $query_result = http_build_query($query);

        // first page url
        $pagination['firstUrl'] = base_url('/corsi').'?'.$query_result;

        // replace parameter(s)
        $query['page'] = $pagination['totalPages'];
        // rebuild url
        $query_result = http_build_query($query);

        // last page url
        $pagination['lastUrl'] = base_url('/corsi').'?'.$query_result;

        $pagination['pages'] = [];
        for ($i=1; $i <= $pagination['totalPages']; $i++) { 
            // replace parameter(s)
            $query['page'] = $i;
            // rebuild url
            $query_result = http_build_query($query);

            array_push($pagination['pages'], ['url' => base_url('/corsi').'?'.$query_result, 'pageNumber' => $i, 'active' => $i == $currentPage]);
        }

        $data['pagination'] = $pagination;
        $data['corsi'] = $db->query("SELECT * FROM ({$courses('corsi')} UNION $moduloQuery) as a_table LIMIT $perPage OFFSET $offset")->getResultArray();
        // $pag = Paginator::createFromResult($data['corsi'], 1, 3);
        // $data['pagination'] = $corsi->pager->links('corsi','front_courses_pagination');


        // get prices by prof
        if((session('user_data')['role'] ?? '') == 'participant'){
            $idsCorsi = array_map(function ($el){if($el['corsi_id'] == '') return $el['id'];}, $data['corsi']);
            $idsModulo = array_map(function ($el){if($el['corsi_id'] != '') return $el['id'];}, $data['corsi']);

            $discountsCorsi = $this->CorsiPrezzoProfModel->whereIn('id_corsi', $idsCorsi ?: ['impossible value'])->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();
            $discountsModulo = $this->CorsiModuloPrezzoProfModel->whereIn('id_modulo', $idsModulo ?: ['impossible value'])->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();

            $discounts = array_merge($discountsCorsi, $discountsModulo);
        }


        $dates = array_map(function($el){return explode(',',$el['dates']);},$data['corsi']);
        $dateIds = [];
        foreach ($dates as $date) {
            foreach ($date as $d) {
                array_push($dateIds,$d);
            }
        }
        $dates = $this->CorsiModuloDateModel->whereIn('id', $dateIds ?: ['impossible value'])->find();
        foreach ($data['corsi'] as $key => &$course) {
            $course['available_dates'] = array_filter($dates, function($el) use ($course){return in_array($el['id'], explode(',', $course['dates']));});
            // get profs for this course
            $this->discounts($course, $discounts ?? []);
        }
        $db      = \Config\Database::connect();
        // echo '<pre>';
        // print_r($data['corsi']);
        // echo '</pre>';
        // exit;
        // die(var_dump($data['category']));
		$inf_page=$this->PagesModel->where('url','corsi')->where('id_ente',$data['selected_ente']['id'])->first();
		$data['seo_title']=$inf_page['seo_title'];
		$data['seo_description']=$inf_page['seo_description'];
        return view($data['view_folder'].'/courses', $data);
    }

    public function details($url)
    {
        $data = $this->common_data();
		$settings=$data['settings'];
        $joinLoggedIn = isset(session('user_data')['profile']['professione']) ? 'AND (prezz.id_professione = '.(session('user_data')['profile']['professione']).')' : '';
        $data['corsi'] = $this->CorsiModel  ->select('corsi.*')
                                            ->where('corsi.id_ente', $data['selected_ente']['id'])
                                            ->where('corsi.url', $url)
                                            ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id AND cm.banned = "no"  AND cm.status = "si"', 'left')
                                            ->join('corsi_pdf_lib pdf', 'find_in_set(pdf.id, corsi.ids_pdf) > 0 AND pdf.accesso = "public"', 'left')
                                            ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0', 'left')
                                            ->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0', 'left')
                                            ->join('argomenti arg', 'arg.idargomenti = corsi.id_argomenti', 'left')
                                            ->join('corsi_prezzo_prof prezz', '(prezz.id_corsi = corsi.id)'. $joinLoggedIn, 'left')
                                            ->select("corsi.*, MAX(prezz.prezzo) as max_price, MIN(prezz.prezzo) as min_price, SUM(cm.crediti) as ECM , pdf.id as pdf, GROUP_CONCAT(DISTINCT u.display_name) doctor_names, GROUP_CONCAT(DISTINCT cat.titolo) categories, arg.nomeargomento")
                                            ->groupBy('corsi.id')
                                            ->first();
        // echo '<pre>';
        // print_r($data['corsi']);
        // echo '</pre>';
        // exit;
        $data['doctors'] = $this->UserModel->join('user_cv cv', 'cv.user_id = users.id', 'left')->join('user_profile profile', 'profile.user_id = users.id', 'left')->where("find_in_set(users.id, '{$data['corsi']['ids_doctors']}') > 0")->select('users.*,profile.logo ,cv.cv as cv')->find();
        
        
        $data['module'] = $this->CorsiModuloModel   ->where('corsi_modulo.id_corsi', $data['corsi']['id'])
                                                    ->join('users u', 'u.id = instructor')
                                                    ->join('corsi', 'corsi.id = corsi_modulo.id_corsi')
                                                    ->join('corsi_modulo_prezzo_prof prezz', '(corsi_modulo.id = prezz.id_modulo)'. $joinLoggedIn, 'left')
                                                    ->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0', 'left')
                                                    ->where('corsi_modulo.banned','no')
                                                    ->where('corsi_modulo.status','si')
                                                    ->select('  corsi_modulo.*, 
                                                                u.display_name,
                                                                MAX(prezz.prezzo) as max_price, 
                                                                MIN(prezz.prezzo) as min_price, 
                                                                GROUP_CONCAT(DISTINCT cat.titolo) categories
                                                            ')
                                                    ->groupBy('corsi_modulo.id')
                                                    ->find();
        
        
        $idsModulo = array_map(function ($el){return $el['id'];}, $data['module']);

        if((session('user_data')['role'] ?? '') == 'participant'){
            $discounts = $this->CorsiPrezzoProfModel->where('id_corsi', $data['corsi']['id'])->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();
            $discountsModulo = $this->CorsiModuloPrezzoProfModel->whereIn('id_modulo', $idsModulo ?: ['impossible value'])->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();
        }

        $data['dates'] = $this->CorsiModuloDateModel->whereIn('id_modulo', $idsModulo ?: ['impossible value'])->where('banned', 'no')->find();
        $data['participation'] = $this->ParticipationModel->whereIn('id_modulo', $idsModulo)->groupBy('id_date')->select('count(id) as count, id_date')->find();

        // echo '<pre>';
        // print_r($data['participation']);
        // echo '</pre>';
        // exit;

        foreach ($data['module'] as &$mod) {
            $mod['dates'] = array_filter($data['dates'], function($el) use ($mod){return $el['id_modulo'] == $mod['id'];});
        }
        $this->discounts($data['corsi'], $discounts ?? []);
        foreach ($data['module'] as &$mod) {
            $this->discounts($mod, $discountsModulo ?? []);
        }
        
		$data['seo_title']=$data['corsi']['seo_title'];
		$data['seo_description']=$data['corsi']['seo_description'];
		if($data['corsi']['foto']!=""){ $seo_image=base_url('uploads/corsi/'.$data['corsi']['foto']);
			$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/corsi/'.$data['corsi']['foto'])
										->getFile()
										->getProperties(true);
		}
		else{ $seo_image=base_url('front/assets/images/courses/img-4.jpg');
		$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/front/assets/images/courses/img-4.jpg')
										->getFile()
										->getProperties(true);
			switch($data['corsi']['tipologia_corsi']){
									case 'online': if(isset( $settings['default_img_online']) && $settings['default_img_online']!=""){
										$seo_image=base_url('uploads/'.$settings['default_img_online']); 
											$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/'.$settings['default_img_online'])
										->getFile()
										->getProperties(true);
									}break;
									case 'aula': if(isset( $settings['default_img_aula']) && $settings['default_img_aula']!=""){
										$seo_image=base_url('uploads/'.$settings['default_img_aula']); 
											$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/'.$settings['default_img_aula'])
										->getFile()
										->getProperties(true);
									} 
									break;
									case 'webinar': if(isset( $settings['default_img_webinar']) && $settings['default_img_webinar']!=""){
									 $seo_image=base_url('uploads/'.$settings['default_img_webinar']); 
											$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/'.$settings['default_img_webinar'])
										->getFile()
										->getProperties(true);
									}
									break;
								}
			
		}
		
			
			$data['seo_image_info']=$info;
        $data['seo_image']=$seo_image;
        // die(print_r($data['dates']));
        return view($data['view_folder'].'/detaglio-corso', $data);
        
    }


    public function detailsModulo($url)
    {
        $data = $this->common_data();

        $joinLoggedIn = isset(session('user_data')['profile']['professione']) ? 'AND (prezz.id_professione = '.(session('user_data')['profile']['professione']).')' : '';
        

        $data['module'] = $this->CorsiModuloModel   ->where('corsi_modulo.url', $url)
                                                    ->join('users u', 'u.id = instructor', 'left')
                                                    ->join('corsi', 'corsi.id = corsi_modulo.id_corsi')
                                                    ->join('corsi_modulo_prezzo_prof prezz', '(corsi_modulo.id = prezz.id_modulo)'. $joinLoggedIn, 'left')
                                                    ->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0', 'left')
                                                    ->select('  corsi_modulo.*,
                                                                corsi.tipologia_corsi,
                                                                u.display_name,
                                                                MAX(prezz.prezzo) as max_price, 
                                                                MIN(prezz.prezzo) as min_price, 
                                                                GROUP_CONCAT(DISTINCT cat.titolo) categories
                                                            ')
                                                    ->where('corsi_modulo.banned', 'no')
                                                    ->where('corsi.id_ente', $data['selected_ente']['id'])
                                                    ->where('corsi_modulo.status', 'si')
                                                    ->groupBy('corsi_modulo.id')
                                                    ->first();

        // echo '<pre>';
        // print_r($data['module']);
        // echo '</pre>';
        // exit;
        $data['corsi'] = $this->CorsiModel          ->where('corsi.id_ente', $data['selected_ente']['id'])
                                                    ->where('corsi.id', $data['module']['id_corsi'])
                                                    ->join('corsi_modulo cm', 'cm.id_corsi = corsi.id AND cm.banned = "no" AND cm.status = "si"', 'left')
                                                    ->join('corsi_pdf_lib pdf', 'find_in_set(pdf.id, corsi.ids_pdf) > 0 AND pdf.accesso = "public"', 'left')
                                                    ->join('users u', 'find_in_set(u.id, corsi.ids_doctors) > 0', 'left')
                                                    ->join('categorie cat', 'find_in_set(cat.id, corsi.id_categorie) > 0', 'left')
                                                    ->join('argomenti arg', 'arg.idargomenti = corsi.id_argomenti', 'left')
                                                    ->join('corsi_prezzo_prof prezz', '(prezz.id_corsi = corsi.id)'. $joinLoggedIn, 'left')
                                                    ->select("  corsi.*, 
                                                                MAX(prezz.prezzo) as max_price, 
                                                                MIN(prezz.prezzo) as min_price, 
                                                                SUM(cm.crediti) as ECM , 
                                                                pdf.filename as pdf, 
                                                                GROUP_CONCAT(DISTINCT u.display_name) display_name, 
                                                                GROUP_CONCAT(DISTINCT cat.titolo) categories, 
                                                                arg.nomeargomento
                                                            ")
                                                    ->groupBy('corsi.id')
                                                    ->first();

        if ($data['corsi']['tipologia_corsi'] != 'online') {
            $data['dates'] = $this->CorsiModuloDateModel->where('id_modulo', $data['module']['id'])->where('banned', 'no')->find();
        }
        $data['participation'] = $this->ParticipationModel->where('id_modulo', $data['module']['id'])->groupBy('id_user')->select('count(id) as count')->first();

        $data['doctors'] = $this->UserModel->join('user_cv cv', 'cv.user_id = users.id', 'left')->join('user_profile profile', 'profile.user_id = users.id', 'left')->where("find_in_set(users.id, '{$data['module']['instructor']}') > 0")->select('users.*,profile.logo ,cv.cv as cv')->find();
        // $data['doctors'] = $this->UserModel->where("find_in_set(id, '{$data['module']['instructor']}') > 0")->find();
        // echo '<pre>';
        // print_r($data['corsi']);
        // echo '</pre>';
        // exit;
        if((session('user_data')['role'] ?? '') == 'participant'){
            $discounts = $this->CorsiPrezzoProfModel->where('id_corsi', $data['corsi']['id'])->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();
            // $idsModulo = array_map(function ($el){return $el['id'];}, $data['module']);
            $discountsModulo = $this->CorsiModuloPrezzoProfModel->where('id_modulo', $data['module']['id'])->where('id_professione', session('user_data')['profile']['professione'] ?? '')->find();
        }

        $this->discounts($data['corsi'], $discounts ?? []);
        // foreach ($data['module'] as &$mod) {
            $this->discounts($data['module'], $discountsModulo ?? []);
        // }
        
		$data['seo_title']=$data['module']['seo_title'];
		$data['seo_description']=$data['module']['seo_description'];
		if($data['module']['foto']!=""){
			$seo_image=base_url('uploads/corsi/'.$data['module']['foto']);
			$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/corsi/'.$data['module']['foto'])
										->getFile()
										->getProperties(true);
		}
		else{ $seo_image=base_url('front/assets/images/courses/img-4.jpg');
		$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/front/assets/images/courses/img-4.jpg')
										->getFile()
										->getProperties(true);
			switch($data['corsi']['tipologia_corsi']){
									case 'online': if(isset( $settings['default_img_online']) && $settings['default_img_online']!=""){
										$seo_image=base_url('uploads/'.$settings['default_img_online']); 
											$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/'.$settings['default_img_online'])
										->getFile()
										->getProperties(true);
									}break;
									case 'aula': if(isset( $settings['default_img_aula']) && $settings['default_img_aula']!=""){
										$seo_image=base_url('uploads/'.$settings['default_img_aula']); 
											$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/'.$settings['default_img_aula'])
										->getFile()
										->getProperties(true);
									} 
									break;
									case 'webinar': if(isset( $settings['default_img_webinar']) && $settings['default_img_webinar']!=""){
									 $seo_image=base_url('uploads/'.$settings['default_img_webinar']); 
											$info = \Config\Services::image()
										->withFile(ROOTPATH.'public/uploads/'.$settings['default_img_webinar'])
										->getFile()
										->getProperties(true);
									}
									break;
								}
			
		}
		
			$data['seo_image_info']=$info;
		$data['seo_image']=$seo_image;
        return view($data['view_folder'].'/detaglio-modulo', $data);
        
    }
}
