<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        // Do something here
        if(! session()->get('isLoggedIn')){

          return redirect()->to('login');
        }
        else {
            if(session()->get('role') == 0){
                // return redirect()->to('dashboard');
            }
            else {
                return redirect()->to('home');

            }
        }


    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}