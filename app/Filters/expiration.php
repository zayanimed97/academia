<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class expiration implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        $session = Services::session();
        $user_data=$session->get('user_data');
        $curdate = strtotime(date('Y-m-d'));
        $mydate = strtotime($user_data['ente_package']['expired_date']);

        $expired = $curdate > $mydate;
        if ( $expired )
        { 
            
            return redirect()->to(base_url('/admin/dashboard'));
        } 
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
    }

}
?>