<?php namespace App\Controllers;
use App\Models\MetaModel;
use App\Models\HeaderModel;
use App\Models\InfoModel;
use App\Models\CategoryModel;
use App\Models\Sub_CategoryModel;
use App\Models\PostModel;
class Dashboard extends BaseController
{
	
	public $data;
	public $meta;
	public $header;
	public $info;
	public $category;
	public $sub_category;
	public $post;
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
		$this->sub_category = new Sub_CategoryModel();
		$this->post = new PostModel();
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
	public function sub_category()
	{
		$this->data = [
			'title' => 'Quản lí danh mục',
			'page' => 'Quản lí danh mục',
			'category' => $this->category->findAll(),
			'sub_category' => $this->sub_category->findAll(),
		];
		echo view('admin/sub_category' , $this->data);
	}
	public function post()
	{
		$this->data = [
			'title' => 'Quản lí bài viết',
			'page' => 'Quản lí bài viết',
			'category' => $this->category->findAll(),
			'sub_category' => $this->sub_category->findAll(),
			'post' => $this->post->findAll(),
		];
		echo view('admin/post' , $this->data);
	}
	public function edit_post($slug)
	{
		$get_category = $this->post->where('slug' , $slug)->first();
		$category = $get_category['category'];
		$category_name = $this->category->where('id' , $category)->first();
		$get_sub_category = $this->post->where('slug' , $slug)->first();
		$sub_category = $get_sub_category['sub_category_select'];
		$sub_category_name = $this->sub_category->where('id' , $sub_category)->first();
		$this->data = [
			'title' => 'Chỉnh sửa bài viết',
			'page' => 'Chỉnh sửa bài viết',
			'category' => $this->category->findAll(),
			'sub_category' => $this->sub_category->findAll(),
			'post' => $this->post->where('slug' , $slug)->first(),
			'sub_category_name' => $sub_category_name,
			'category_name' => $category_name,
		];
		echo view('admin/edit_post' , $this->data);
		// echo "<pre>";
		// print_r($this->data);
		
	}
}