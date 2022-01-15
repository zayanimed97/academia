<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Controllers\Front\UserController;

class remember_me implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        if (($request->getUri() != base_url('logout')) && ($request->getUri() != base_url('user/login'))) {
            helper('cookie');
            $email = get_cookie('email');
            $password = get_cookie('password');
            $session = Services::session();
            $user_data=$session->get('user_data');
            if (is_null($user_data) && !is_null($email) && !is_null($password)) {
                $session->set(['intended' => $request->getUri()]);
                return redirect()->to(base_url('user/login'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
    }

}
?>