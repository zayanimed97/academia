<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        $session = Services::session();
        $user_data=$session->get('user_data');
        // die(var_dump($arguments));
        if (!in_array($user_data['role'] ?? NULL , $arguments ?? []) )
        { 
            // if ($request->uri->getPath() == '/login')
            // {
            //     switch ($user_data['role']) {
            //         case 'ente':
            //             return redirect()->to('/admin/dashboard');
            //             break;
            //         case 'superadmin':
            //             return redirect()->to('/superadmin/dashboard');
            //         default:
            //             return;
            //             break;
            //     } 
                
            // }
            if (in_array('participant', $arguments ?? [])) {
                return redirect()->to(base_url('/user/login'));
            }
            return redirect()->to(base_url('/admin/login'));
        } 
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
    }

}
?>