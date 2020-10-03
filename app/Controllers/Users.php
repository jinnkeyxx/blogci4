<?php namespace App\Controllers;
use App\Models\UserModel;
class Users extends BaseController
{
	
    public $data;
    public $user;
    public $status;
    public $messages;
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		
        $this->data = [];
        $this->user = new UserModel();

	}
	public function login()
	{
        
        $rules = [
            'username' => 'required|min_length[6]|max_length[20]',
            'password' => 'required|min_length[6]|max_length[255]|validateUser[username,password]',
        ];

        $errors = [
            'username' => [
                'required' => 'không được bỏ trống',
                'min_length' => 'tài khoản không được nhỏ hơn 6 kí tự', 
                'max_length' => 'Tài khoản không được lớn hơn 20 kí tự',
            ],
            'password' => [
                'validateUser' => 'Tài khoản hoặc mật khẩu không đúng',
                'required' => 'Không được bỏ trống', 
                'min_length' => 'Mật khẩu không được nhỏ hơn 6 kí tự',
                'max_length' => 'Mật khẩu quá dài',
            ]
        ];

        if (! $this->validate($rules, $errors)) {
            $data['validation'] = $this->validator;
            // var_dump($this->validator->listErrors());
            die(json_encode(array('status' => false , 'messages' => $this->validator->listErrors())));
        }else{
            $user = $this->user->where('username', $this->request->getVar('username'))->first();

            // $this->setUserSession($user);
            var_dump($user);
            //$session->setFlashdata('success', 'Successful Registration');
            // return redirect()->to('dashboard');

        }
	}
	
	private function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}
    public function registration()
    {
        $this->data = [
            'title' => 'registration',
        ];
        echo view('registration' , $this->data);
    }
    public function register()
    {
        $rules = [
            'fullname' => 'required|min_length[3]|max_length[20]',
            'username' => 'required|min_length[6]|max_length[50]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'matches[password]',
        ];
        $errors = [
            'username' => [
                'required' => 'không được bỏ trống',
                'min_length' => 'tài khoản không được nhỏ hơn 6 kí tự', 
                'max_length' => 'Tài khoản không được lớn hơn 20 kí tự',
            ],
            'password' => [
                'validateUser' => 'Tài khoản hoặc mật khẩu không đúng',
                'required' => 'Không được bỏ trống', 
                'min_length' => 'Mật khẩu không được nhỏ hơn 6 kí tự',
                'max_length' => 'Mật khẩu quá dài',
            ]
        ];

        if (! $this->validate($rules , $errors)) {
            $data['validation'] = $this->validator;
        }else{
            

            $newData = [
                'firstname' => $this->request->getVar('firstname'),
                'lastname' => $this->request->getVar('lastname'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];
            $this->user->save($newData);
            // $session = session();
            // $session->setFlashdata('success', 'Successful Registration');
            // return redirect()->to('/');

        }
    }
	//--------------------------------------------------------------------

}