<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloTestQuestionsModel extends Model
{
	
    protected $table = 'corsi_modulo_test_questions';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_test', 'type','question','nb_response','time','banned'];
	
	protected $returnType = 'array';
	
	
}