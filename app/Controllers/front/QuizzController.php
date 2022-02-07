<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class QuizzController extends BaseController
{
    public function index($type, $id)
    {
        $data=$this->common_data();
        $data['questions'] = $this->CorsiModuloTestQuestionsModel   ->join('corsi_modulo_test cmt', 'cmt.id = corsi_modulo_test_questions.id_test')
                                                                    ->join('test_modulo tm', 'cmt.id = tm.id_test')
                                                                    ->join($type == 'corsi' ? 'corsi c' : 'corsi_modulo c', 'c.id = '.($type == 'corsi' ? 'tm.id_corsi' : 'tm.id_modulo'))
                                                                    ->where('c.id', $id)
                                                                    ->where('cmt.id_ente', $data['selected_ente']['id'])
                                                                    ->select('corsi_modulo_test_questions.*, cmt.id as id_quizz')
                                                                    ->find();
        $data['id_quizz'] = $data['questions'][0]['id_quizz'] ?? null;
        
        $questIds = array_map(function($el){return $el['id'];}, $data['questions']);
        $responses = $this->CorsiModuloTestResponsesModel->whereIn('id_q', $questIds)->select('corsi_modulo_test_responses.id,corsi_modulo_test_responses.id_q,corsi_modulo_test_responses.response')->find();

        foreach ($data['questions'] as &$quest) {
            $quest['reponses'] = array_filter($responses, function($el) use ($quest){return $el['id_q'] == $quest['id'];});
        }
        // echo '<pre>';
        // print_r($data['questions']);
        // echo '</pre>';
        // exit;
        return view($data['view_folder'].'/quizz', $data);
    }

    public function submitQuizz()
    {
        // $questions = $this->CorsiModuloTestQuestionsModel->whereIn('id', $this->request->getVar('questions'))->find();
        $rightResponses = $this->CorsiModuloTestResponsesModel->whereIn('id_q', $this->request->getVar('questions'))->groupBy('id_q')->join('corsi_modulo_test_questions quest', 'id_q = quest.id')->select('GROUP_CONCAT(corsi_modulo_test_responses.id) as ids, id_q, quest.type')->where('points > 0')->find();
        $falseResponses = $this->CorsiModuloTestResponsesModel->whereIn('id_q', $this->request->getVar('questions'))->groupBy('id_q')->select('GROUP_CONCAT(id) as ids, id_q')->where('points = 0')->find();
        
        
        $selectedResponses = $this->CorsiModuloTestResponsesModel->whereIn('id', $this->request->getVar('responses'))->find();

        foreach ($rightResponses as &$rightRes) {
            $questId = $rightRes['id_q'];
            $wrong = array_filter($falseResponses, function($el) use ($questId){return $el['id_q'] == $questId;});
            $rightRes['wrongIds'] = reset($wrong)['ids'] ?? '';
        }
        
        $score = 0;
        foreach ($rightResponses as $res) {
            $corrects = [];
            $wrongs = [];
            foreach ($this->request->getVar('responses') as $r) {
                if(in_array($r, explode(',', $res['ids']))){
                    array_push($corrects, $r);
                } 
                if(in_array($r, explode(',', $res['wrongIds']))){
                    array_push($wrongs, $r);
                } 
            }
            if (count($wrongs) == 0) {
                if ($res['type'] == 'unica' || ($res['type'] == 'multipla' && (count($corrects) == count(explode(',', $res['ids']))))) {
                    $scoreCounts = array_filter($selectedResponses, function($el) use ($corrects){return in_array($el['id'], $corrects);});
                    $scoreSum = array_map(function($el){return $el['points'];}, $scoreCounts);
                    $score += array_sum($scoreSum);
                }
            }
        }
        echo '<pre>';
        print_r($score);
        echo '</pre>';
        exit;
        $sum_points = array_sum(array_map(function($el){return $el['points'];}, $selectedResponses));
        return json_encode(['min_points' => $quizz['min_points'], 'sum_points' => $sum_points]);
    }
}
