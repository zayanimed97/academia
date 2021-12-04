<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UserProfileModel extends Model
{
	
    protected $table = 'user_profile';
	protected $primaryKey = 'id';
    protected $allowedFields = [ 'newsletter','user_id','nome','cognome','email','telefono','cf',
	'residenza_stato','residenza_provincia','residenza_comune','residenza_cap','residenza_indirizzo','nascita_data','nascita_stato','nascita_provincia',
	'professione','disciplina','professione_citta','abo','posizione','type','piva','fattura_nome','fattura_cognome','note',
	'ragione_sociale','fattura_piva','fattura_cf','fattura_stato','fattura_provincia','fattura_comune','fattura_cap','fattura_indirizzo','fattura_pec','fattura_sdi','fattura_phone',
	'dettagli','description','logo','argomenti','prof_albo','titolo','del','mobile','email_private','site_web','email_web','qualifica','prima'];
	//protected $useTimestamps = true;
	//protected $useSoftDeletes = false;
	protected $returnType = 'array';
	//protected $deletedField  = 'deleted_at';

	
}