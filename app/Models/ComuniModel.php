<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ComuniModel extends Model
{
	
    protected $table = 'comuni';
	protected $primaryKey = 'id';
    protected $allowedFields = ['id_nazione', 'id_prov','cod_reg','cod_istat','comune','prov', 'cittadinanza','catasto','cap','pref_tel','lat','long'];
	
	protected $returnType = 'array';
	
	
}