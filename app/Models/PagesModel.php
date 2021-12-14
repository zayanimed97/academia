<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PagesModel extends Model
{
	
    protected $table = 'pages';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_ente','type', 'menu_title','title','content','seo_title','seo_description','ord','enable','banned','url'];
	
	protected $returnType = 'array';
	
	
}