<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class TemplatesModel extends Model
{
    protected $table = 'templates';
	protected $primaryKey = 'id';
    protected $allowedFields = ['module','titolo', 'subject','html','id_ente','helps'];
	
	protected $returnType = 'array';
	
	
}