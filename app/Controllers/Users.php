<?php namespace App\Controllers;
use App\Models\UserModel;
use App\Models\InfoModel;
class Users extends BaseController
{
	
    public $data;
    public $user;
    public $status;
    public $messages;
    public $fb;
    public $fb_helper;
    public $google;
    public $info;
    public $app;
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		
        $this->data = [];
        $this->user = new UserModel();
        $this->info = new InfoModel();
        $this->app = $this->info->where('id' , 1)->first();
        require_once APPPATH.'Libraries/vendor/autoload.php';
        $this->fb = new \Facebook\Facebook([
            'app_id' => $this->app['appid_fb'],
            'app_secret' => $this->app['appsecret_fb'],
            'default_graph_version' => 'v2.7'
        ]);
        $this->fb_helper = $this->fb->getRedirectLoginHelper();
        $this->google = new \Google_Client();
        $this->google->setClientId($this->app['appid_gg']);
        $this->google->setClientSecret($this->app['appsecret_gg']);
        $this->google->setRedirectUri(base_url().'/logingoogle');
        $this->google->addScope('email');
        $this->google->addScope('profile');
    }
    public function index()
	{
        
        
        $redirectURL = base_url().'/loginfacebook';
		$this->data = [
            'title' => 'Login',
            'loginfb' =>$this->fb_helper->getLoginUrl($redirectURL),
            'logingg' => $this->google->createAuthUrl(),

		
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
    public function logout(){
		session()->destroy();
		return redirect()->to(base_url());
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
    public function loginFacebook()
    {

        if($this->request->getVar('state'))
        {
            $this->fb_helper->getPersistentDataHandler()->set('state' , $this->request->getVar('state'));
     
        }
        if($this->request->getVar('code'))
        {
            
            if(session()->get('access_token'))
            {
                $access_token = (string)session()->get('access_token');
            }
            else 
            {
                $access_token = $this->fb_helper->getAccessToken();
                session()->get('access_token' , $access_token);
                $this->fb->setDefaultAccessToken((string)session()->get('access_token'));
            }
            $graph_respone = $this->fb->get('/me?locale=vi_VN&fields=name,email' ,  $access_token);
            $fb_user_info = $graph_respone->getGraphUser();
          
            if(!empty($fb_user_info['id']))
            {
                $newData = [
                    // 'profile_pic' => 'https://graph.facebook.com/'.$fb_user_info['id'].'picture',
                    'fullname' => $fb_user_info['name'],
                    'username' => $fb_user_info['email'],
                    'email' => $fb_user_info['email'],
                    'password' => md5($fb_user_info['email']),
                    'role' => 1,
                ];
                $user = $this->user->where('username', $fb_user_info['email'])->first();
                if($user == NULL)
                {
                    $this->user->save($newData);
                    $user = $this->user->where('username', $fb_user_info['email'])->first();
                    $this->setUserSession($user);
                }
                else {
                     $this->setUserSession($user);
                }
                return redirect()->to('home');
                // echo "<pre>";
                // print_r($newData);
            }
        }
        
    }
    public function logingoogle()
    {
        if($this->request->getVar('code'))
        {
            $token = $this->google->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
            if(!isset($token['error']))
            {
                $this->google->setAccessToken($token['access_token']);
                session()->set('access_token' , $token['access_token']);
                $google_service = new \Google_Service_Oauth2($this->google);
                $this->data = $google_service->userinfo->get();
                // print_r($this->data);
                $newData = [
                    'fullname' => $this->data['given_name'] . $this->data['family_name'],
                    'username' => $this->data['email'],
                    'email' => $this->data['email'],
                    'password' => md5($this->data['email']),
                    'role' => 1,
                ];
                $user = $this->user->where('username', $this->data['email'])->first();
                if($user == NULL)
                {
                    $this->user->save($newData);
                    $user = $this->user->where('username', $this->data['email'])->first();
                    $this->setUserSession($user);
                }
                else {
                     $this->setUserSession($user);
                }
                return redirect()->to('home');
            }
        }
    }
	//--------------------------------------------------------------------

}