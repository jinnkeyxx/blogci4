<?php namespace App\Controllers;
use App\Models\MetaModel;
use App\Models\HeaderModel;
use App\Models\InfoModel;

class Settings extends BaseController
{
	
	public $data;
	public $meta;
	public $header;
	public $info;
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		
		$this->data = [];
		$this->meta = new MetaModel();
		$this->header = new HeaderModel();
		$this->info = new InfoModel();

	}
	
	public function setting_meta()
	{
		$rules = [
			'description' => 'required|min_length[6]',
			'copyright' => 'required|min_length[6]',
			'author' => 'required|min_length[6]',
			'region' => 'required|min_length[6]',
			'position' => 'required|min_length[6]',
			'ICBM' => 'required|min_length[6]',
		];
		$errors = [
			'description' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
			'copyright' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
			'author' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
			'region' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
			'position' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
			'ICBM' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
		];
		if (!$this->validate($rules, $errors)) 
		{
			
			die(json_encode(array('status' => false , 'messages' => $this->validator->listErrors())));
		}
		else
		{
			$newData = [
				'id' => 1,
				'description' => $this->request->getVar('description'),
				'copyright' => $this->request->getVar('copyright'),
				'author' => $this->request->getVar('author'),
				'region' => $this->request->getVar('region'),
				'position' => $this->request->getVar('position'),
				'ICBM' => $this->request->getVar('ICBM'),
			];
			
			if($this->meta->save($newData))
			{
				die(json_encode(array('status' => true , 'messages' => 'Cập nhật thành công')));

			}
			else 
			{
				die(json_encode(array('status' => false , 'messages' => 'Chưa lưu được')));
			}
		}
	}
	public function setting_header()
	{
		$newData = [
			'id' => 1,
			'title_logo' => $this->request->getVar('title_logo'),
			'title_banner' => $this->request->getVar('title_banner'),
		];
		if($this->request->getFile('logo'))
		{
			$rules = [
				'logo' => 'uploaded[logo]|max_size[logo,1024]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
				
			];
			$errors = [
				'logo' => [
					'uploaded' => 'Vui lòng upload ảnh',
					'max_size' => 'ảnh vượt quá giới hạn',
					'is_image' => 'không phải ảnh',
					'mime_in' => 'Ảnh không đúng định dạng',
				],
			];
			
			if (!$this->validate($rules , $errors)) 
			{
				
				die(json_encode(array('status' => false , 'messages' => $this->validator->listErrors())));
			}
			else
			{
				$logo = $this->request->getFile('logo');
				$name_logo = $logo->getRandomName();
				$logo->move('public/home/assets/images/icons' , $name_logo);
				$newData['logo'] = base_url() .'/public/home/assets/images/icons/'.$name_logo;

			}
		}
		if($this->request->getFile('banner'))
		{
			$rules = [
				'banner' => 'uploaded[banner]|max_size[banner,1024]|is_image[banner]|mime_in[banner,image/jpg,image/jpeg,image/png]',
			];
			$errors = [
				'logo' => [
					'uploaded' => 'Vui lòng upload ảnh',
					'max_size' => 'ảnh vượt quá giới hạn',
					'is_image' => 'không phải ảnh',
					'mime_in' => 'Ảnh không đúng định dạng',
				],
			];
			if (!$this->validate($rules , $errors)) 
			{
				die(json_encode(array('status' => false , 'messages' => $this->validator->listErrors())));
			}
			else
			{
				$banner = $this->request->getFile('banner');
				$name_banner = $banner->getRandomName();
				$banner->move('public/home/assets/images/icons' , $name_banner);
				$newData['banner'] = base_url() .'/public/home/assets/images/icons/'.$name_banner;
			}
		}
		if($this->header->save($newData))
		{
			die(json_encode(array('status' => true , 'messages' => "Cập nhật thành công")));
		}
		
		
	}
	public function setting_info()
	{
		$rules = [
			'facebook' => 'required|min_length[6]|valid_url[facebook]',
			'gmail' => 'required|min_length[6]|valid_email[gmail]',
			'youtube' => 'required|min_length[6]|valid_url[youtube]',
			'appid_fb' => 'required|min_length[6]',
			'appsecret_fb' => 'required|min_length[6]',
			'appid_gg' => 'required|min_length[6]',
			'appsecret_gg' => 'required|min_length[6]',
		];
		$errors = [
			'facebook' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự',
				'valid_url' => 'Facebook phải đúng định dạng url',
			],
			'gmail' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự',
				'valid_email' => 'Email phải đúng định dạng',
			],
			'youtube' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự',
				'valid_url' => 'Youtube không đúng định dạng url',
			],
			'appid_fb' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
			'appsecret_fb' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
			'appid_gg' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
			'appsecret_gg' => [
				'required' => 'Không được bỏ trống',
				'min_length' => 'Không được nhỏ hơn 6 kí tự'
			],
		];
		if (!$this->validate($rules, $errors)) 
		{
			
			die(json_encode(array('status' => false , 'messages' => $this->validator->listErrors())));
		}
		else
		{
			$newData = [
				'id' => 1,
				'facebook' => $this->request->getVar('facebook'),
				'gmail' => $this->request->getVar('gmail'),
				'youtube' => $this->request->getVar('youtube'),
				'appid_fb' => $this->request->getVar('appid_fb'),
				'appsecret_fb' => $this->request->getVar('appsecret_fb'),
				'appid_gg' => $this->request->getVar('appid_gg'),
				'appsecret_gg' => $this->request->getVar('appsecret_gg'),

			];
			
			if($this->info->save($newData))
			{
				die(json_encode(array('status' => true , 'messages' => 'Cập nhật thành công')));

			}
			else 
			{
				die(json_encode(array('status' => false , 'messages' => 'Chưa lưu được')));
			}
		}
	}
}