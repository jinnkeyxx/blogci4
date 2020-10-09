<?php namespace App\Controllers;
use App\Models\MetaModel;
use App\Models\HeaderModel;
use App\Models\InfoModel;
use App\Models\CategoryModel;
class Dashboard extends BaseController
{
	
	public $data;
	public $meta;
	public $header;
	public $info;
	public $category;
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		
		$this->data = [];
		$this->meta = new MetaModel();
		$this->header = new HeaderModel();
		$this->info = new InfoModel();
		$this->category = new CategoryModel();
	}
	public function index()
	{
		$this->data = [
			'title' => 'Dashboard',
			'page' => 'Dashboard',
			
		];
		echo view('admin/dashboard' , $this->data);
	}
	public function setting_meta()
	{
		$this->data = [
			'title' => 'Setting Meta',
			'page' => 'Setting Meta',
			'meta' => $this->meta->first()		
		];
		echo view('admin/setting-meta' , $this->data);
	}
	
	public function setting_header()
	{
		$this->data = [
			'title' => 'Setting Header',
			'page' => 'Setting Header',
			
			'header' => $this->header->first(),
		];
		echo view('admin/setting-header' , $this->data);
	}
	public function setting_info()
	{
		$this->data = [
			'title' => 'Setting Info',
			'page' => 'Setting Info',
			'info' =>$this->info->first(),
		];
		echo view('admin/setting-info' , $this->data);
	}
	public function write_post()
	{
		$this->data = [
			'title' => 'Viết bài',
			'page' => 'Viết bài mới',
			
			'category' => $this->category->findAll(),
		];
		// $category = $this->category->findAll();
		// var_dump($category);
		echo view('admin/write-post' , $this->data);
	}
	public function category()
	{
		$this->data = [
			'title' => 'Quản lí danh mục',
			'page' => 'Quản lí danh mục',
			'category' => $this->category->findAll(),
		];
		echo view('admin/category' , $this->data);

	}
 	private function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}