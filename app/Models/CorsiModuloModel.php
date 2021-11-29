<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiModuloModel extends Model
{
	
    protected $table = 'corsi_modulo';
	protected $primaryKey = 'id';
    protected $allowedFields = ['banned', 'id_corsi','titolo','sotto_titolo','foto','description','instructor','tipologia','test_required','prezzo','codice','crediti','video_promo','url',
	'obiettivi','programa','note','indrizzato_a','riferimenti','avvisi','seo_title','seo_description','attestato','status','ids_pdf','have_def_price','edition','min_points','ord'];
	
	protected $returnType = 'array';
	
	
}