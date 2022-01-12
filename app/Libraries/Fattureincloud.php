<?php

namespace App\Libraries;

class Fattureincloud
{
    // This function converts a string into slug format
    private $uid;
        private $key;

        public function __construct($id = "691507", $key = "fc3b741e2470ea061d69f5485d9f64eb")
        {
            $this->uid = $id;
            $this->key = $key;
        }

        public function newClient(array $info)
        {
            return $this->callAPI("/clienti/nuovo", $info);
        }

        public function clientInfo(array $info)
        {
            return $this->callAPI("/clienti/lista", $info);
        }

        public function newInvoice(array $info)
        {
            return $this->callAPI("/fatture/nuovo", $info);
        }
		
		 public function getPdf($id)
        {
            $details = json_decode($this->listInvoice(["id" => $id]),true);
			return $details['dettagli_documento']['link_doc'];
           // return $details->dettagli_documento->link_doc;
        }

        public function listInvoice($info)
        {
            return $this->callAPI("/fatture/dettagli", $info);
        }
		
        private function callAPI($url, $data = [])
        {
            $url = "https://api.fattureincloud.it/v1/$url";
            $request = array ("api_uid" => $this->uid, "api_key" => $this->key);
            $request = array_merge($data, $request);
            $options = array (
                "http" => array (
                    "header" => "Content-type: text / json \ r \ n",
                    "method" => "POST",
                    "content" => json_encode ($request,true)
                ),
            );
            $context = stream_context_create ($options);
            return file_get_contents ($url, false, $context); 
        }
}