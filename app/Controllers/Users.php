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
    public function index()
	{
		
		$this->data = [
			'title' => 'Login',
		
		];
        echo view('login' , $this->data);
		
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

        if (!$this->validate($rules, $errors)) {
            // $data['validation'] = $this->validator;
            // var_dump($this->validator->listErrors());
            die(json_encode(array('status' => false , 'messages' => $this->validator->listErrors())));
        }else{
            $user = $this->user->where('username', $this->request->getVar('username'))->first();

            $this->setUserSession($user);
            die(json_encode(array('status' => true , 'messages' => 'Đăng nhập thành công')));
            //$session->setFlashdata('success', 'Successful Registration');
            // return redirect()->to('dashboard');

        }
	}
	
	private function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'fullname' => $user['fullname'],
			'username' => $user['username'],
			'email' => $user['email'],
            'isLoggedIn' => true,
            'role' => $user['role'],
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
            'username' => 'required|min_length[6]|max_length[30]|is_unique[users.username]',
            'password' => 'required|min_length[6]|max_length[255]',
            'fullname' => 'required|min_length[3]|max_length[30]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'rppassword' => 'matches[password]',
        ];
        $errors = [
            'username' => [
                'required' => ' Tài khoản không được bỏ trống',
                'min_length' => 'tài khoản không được nhỏ hơn 6 kí tự', 
                'max_length' => 'Tài khoản không được lớn hơn 30 kí tự',
                'is_unique' => 'Tài khoản này đã được đăng kí',
            ],
            'password' => [
                'required' => 'Mật khẩu Không được bỏ trống', 
                'min_length' => 'Mật khẩu không được nhỏ hơn 6 kí tự',
                'max_length' => 'Mật khẩu quá dài',
            ],
            'fullname' => [
                'required' => 'Họ tên Không được bỏ trống' ,
                'min_length' => 'Họ Tên không được nhỏ hơn 3 kí tự',
                'max_length' => 'Họ tên không được lớn hơn 30 kí tự',
            ],
            'email' => [
                'required' => 'Email không được bỏ trống',
                'min_length' => 'Email không được nhỏ hơn 6 kí tự',
                'max_length' => 'Email không được lớn hơn 50 kí tự',
                'valid_email' => 'Email không đúng định dạng' ,
                'is_unique' => 'Email đã được đăng kí',

            ],
            'rppassword' => [
                'matches' => 'Mật khẩu không khớp',
            ],
        ];

        if (! $this->validate($rules ,$errors)) {
				$data['validation'] = $this->validator;
            die(json_encode(array('status' => false , 'messages' => $this->validator->listErrors())));
        }else{
            

            $newData = [
                'fullname' => $this->request->getVar('fullname'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'role' => 1,
            ];
            $this->user->save($newData);
            $user = $this->user->where('username', $this->request->getVar('username'))->first();

            $this->setUserSession($user);
            die(json_encode(array('status' => true , 'messages' => 'Đăng kí thành công')));
            // $session = session();
            // $session->setFlashdata('success', 'Successful Registration');
            // return redirect()->to('/');

        }
    }
	//--------------------------------------------------------------------

}