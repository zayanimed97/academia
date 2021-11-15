<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CorsiPDFLibModel extends Model
{
	
    protected $table = 'corsi_pdf_lib';
	protected $primaryKey = 'id';
    protected $allowedFields = ['pdfname', 'filename','created_at','banned','enable','featured','accesso','id_ente'];
	 
	protected $returnType = 'array';
	
	
}